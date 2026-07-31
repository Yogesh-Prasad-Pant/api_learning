<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{   
    public function store(Request $request, OrderService $orderService): JsonResponse
    {
        $validated = $request->validate([
            'customer_name'    => ['required', 'string', 'max:255'],
            'customer_phone'   => ['required', 'string', 'max:20'],
            'shipping_address' => ['required', 'array'],
            'billing_address'  => ['nullable', 'array'],
            'payment_method'   => ['required', 'string', 'in:cod,stripe,khalti,esewa'],
            'customer_note'    => ['nullable', 'string', 'max:500'],
        ]);

        $orders = $orderService->checkout($request->user(), $validated);

        return response()->json([
            'success' => true,
            'message' => 'Order(s) placed successfully!',
            'data'    => $orders,
        ], 201);
    }

    public function index(Request $request): JsonResponse
    {
        $orders = Order::with(['shop:id,shop_name,logo', 'orderItems'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $orders,
        ]);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $order = Order::with(['shop:id,shop_name,logo', 'orderItems'])
            ->where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data'    => $order,
        ]);
    }

    /**
     * Customer requests cancellation of an order.
     */
    public function requestCancel(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'cancel_reason' => ['required', 'string', 'max:500'],
        ]);

        $order = Order::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        // 1. Prevent cancelling already delivered or cancelled orders
        if (in_array($order->status, ['delivered', 'cancelled', 'returned'])) {
            return response()->json([
                'success' => false,
                'message' => "Order cannot be cancelled because it is already {$order->status}.",
            ], 422);
        }

        // 2. Prevent duplicate cancellation requests
        if ($order->cancel_status === 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'A cancellation request for this order is already pending shop approval.',
            ], 422);
        }

        // 3. Immediate Cancellation for unpaid COD orders before shipping
        if ($order->payment_method === 'cod' && in_array($order->status, ['pending', 'processing'])) {
            $order->update([
                'status'              => 'cancelled',
                'cancel_status'        => 'approved',
                'cancel_reason'        => $request->cancel_reason,
                'cancel_requested_at' => now(),
                'cancelled_at'        => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order cancelled successfully.',
                'data'    => $order,
            ]);
        }

        // 4. Prepaid or already Shipped COD orders require Shop Approval
        $order->update([
            'cancel_status'        => 'pending',
            'cancel_reason'        => $request->cancel_reason,
            'cancel_requested_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cancellation request submitted successfully. Waiting for shop approval.',
            'data'    => $order,
        ]);
    }

    /**
     * Customer confirms physical receipt of the product.
     */
    public function confirmReceived(Request $request, int $id): JsonResponse
    {
        $order = Order::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        // Only allow confirmation if shipped or already marked delivered by courier
        if (!in_array($order->status, ['shipped', 'delivered'])) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot confirm receipt for an order that has not been shipped yet.',
            ], 422);
        }

        if (!is_null($order->customer_received_at)) {
            return response()->json([
                'success' => true,
                'message' => 'You have already confirmed receipt for this order.',
                'data'    => $order,
            ]);
        }

        DB::transaction(function () use ($order) {
            $order->customer_received_at = now();

            // For prepaid orders (eSewa, Khalti, etc.), receipt confirmation completes delivery
            if ($order->payment_method !== 'cod' && $order->payment_status === 'paid') {
                $order->status = 'delivered';
                $order->delivered_at = now();
            }

            $order->save();

            // NOTE: In the Admin/Shop OrderController or WalletService, 
            // when $order->canReleaseVendorFunds() evaluates to true,
            // we credit $order->vendor_earning to $shop->balance.
        });

        return response()->json([
            'success' => true,
            'message' => 'Order marked as received successfully!',
            'data'    => $order->refresh(),
        ]);
    }
}