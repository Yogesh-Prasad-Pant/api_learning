<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutRequest;
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

        if ($validated['amount'] > $activeShop->balance) {
            throw ValidationException::withMessages([
                'amount' => ["Requested amount exceeds your available shop balance of {$activeShop->balance}"],
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

        $payout = PayoutRequest::create([
            'shop_id'         => $activeShop->id,
            'amount'          => $validated['amount'],
            'payment_method'  => $validated['payment_method'],
            'payment_details' => $validated['payment_details'],
            'status'          => 'pending',
        ]);

        return response()->json([
            'message' => 'Payout request submitted successfully.',
            'payout'  => $payout,
        ], 201);
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

        $payout = PayoutRequest::with('shop')->findOrFail($id);

        if (in_array($payout->status, ['completed', 'rejected'])) {
            throw ValidationException::withMessages([
                'status' => ["This payout request has already been finalized as {$payout->status}."],
            ]);
        }

        DB::transaction(function () use ($payout, $validated) {
            $newStatus = $validated['status'];

            if ($newStatus === 'completed' && $payout->status !== 'completed') {
                $shop = $payout->shop;

                if ($shop->balance < $payout->amount) {
                    throw ValidationException::withMessages([
                        'balance' => ['Shop balance is insufficient to process this payout completion.'],
                    ]);
                }

                $shop->decrement('balance', $payout->amount);
                $payout->processed_at = now();
            }

            $payout->update([
                'status'       => $newStatus,
                'admin_note'   => $validated['admin_note'] ?? $payout->admin_note,
                'processed_at' => $payout->processed_at ?? ($newStatus === 'completed' ? now() : null),
            ]);
        });

        return response()->json([
            'message' => "Payout request updated to {$validated['status']} successfully.",
            'payout'  => $payout->fresh('shop'),
        ]);
    }
}