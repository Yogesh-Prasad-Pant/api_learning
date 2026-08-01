<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutRequest;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PayoutRequestController extends Controller
{
    /**
     * List payout requests.
     * - Vendors: See only payouts for their active shop (via HasShopScope).
     * - Superadmin: Sees all payouts across the platform (or filtered by status).
     */
    public function index(Request $request): JsonResponse
    {
        $status = $request->query('status');
        $activeShop = $request->get('active_shop');

        $payouts = PayoutRequest::forShop()
            ->with('shop:id,shop_name,admin_id')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(15);

        return response()->json([
            'shop_balance' => $activeShop?->balance,
            'payouts'      => $payouts,
        ]);
    }

    /**
     * Vendor submits a payout request.
     * Deducts balance immediately into a pending state to avoid double-withdrawal.
     */
    public function store(Request $request): JsonResponse
    {
        /** @var \App\Models\Shop $activeShop */
        $activeShop = $request->get('active_shop');

        if (! $activeShop) {
            throw ValidationException::withMessages([
                'shop' => ['No active shop context found to process payout.'],
            ]);
        }

        $validated = $request->validate([
            'amount'          => ['required', 'numeric', 'min:100'],
            'payment_method'  => ['required', 'string', 'in:ESEWA,KHALTI,BANK_TRANSFER'],
            'payment_details' => ['required', 'array'],
        ]);

        return DB::transaction(function () use ($activeShop, $validated) {
            // Lock shop row to safely verify balance
            $shop = Shop::where('id', $activeShop->id)->lockForUpdate()->first();

            if ($validated['amount'] > $shop->balance) {
                throw ValidationException::withMessages([
                    'amount' => ["Requested amount exceeds your available shop balance of Rs. {$shop->balance}"],
                ]);
            }

            // Prevent duplicate pending requests for the same shop
            $hasPending = PayoutRequest::forShop()
                ->where('status', 'pending')
                ->exists();

            if ($hasPending) {
                throw ValidationException::withMessages([
                    'payout' => ['You already have a pending payout request under review.'],
                ]);
            }

            // Reserve funds immediately upon request
            $shop->decrement('balance', $validated['amount']);

            $payout = PayoutRequest::create([
                'shop_id'         => $shop->id,
                'amount'          => $validated['amount'],
                'payment_method'  => $validated['payment_method'],
                'payment_details' => $validated['payment_details'],
                'status'          => 'pending',
            ]);

            return response()->json([
                'message'     => 'Payout request submitted successfully.',
                'new_balance' => $shop->fresh()->balance,
                'payout'      => $payout,
            ], 201);
        });
    }

    /**
     * Update payout request status (Superadmin Action).
     */
    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'status'     => ['required', 'string', 'in:approved,rejected,completed'],
            'admin_note' => ['nullable', 'string', 'max:500'],
        ]);

        return DB::transaction(function () use ($id, $validated) {
            $payout = PayoutRequest::with('shop')->lockForUpdate()->findOrFail($id);

            if (in_array($payout->status, ['completed', 'rejected'])) {
                throw ValidationException::withMessages([
                    'status' => ["This payout request has already been finalized as {$payout->status}."],
                ]);
            }

            $oldStatus = $payout->status;
            $newStatus = $validated['status'];

            // If rejected, refund reserved balance back to the shop
            if ($newStatus === 'rejected' && $oldStatus !== 'rejected') {
                $payout->shop->increment('balance', $payout->amount);
            }

            $payout->update([
                'status'       => $newStatus,
                'admin_note'   => $validated['admin_note'] ?? $payout->admin_note,
                'processed_at' => $newStatus === 'completed' ? ($payout->processed_at ?? now()) : $payout->processed_at,
            ]);
            
            if ($newStatus === 'completed' && $oldStatus !== 'completed') {
                $payout->shop->increment('total_withdrawn', $payout->amount);
            }

            return response()->json([
                'message' => "Payout request updated to {$newStatus} successfully.",
                'payout'  => $payout->fresh('shop'),
            ]);
        });
    }
}