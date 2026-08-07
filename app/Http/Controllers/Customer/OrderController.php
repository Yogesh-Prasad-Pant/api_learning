<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ShopProduct;
use App\Services\OrderService;
use App\Services\OrderSettlementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\OrderReturnRequestedNotification;
use Throwable;

class OrderController extends Controller
{   
    public function store(Request $request, OrderService $orderService): JsonResponse
    {   
        $user = $request->user();
        $request->merge([
            'customer_name' => $request->input('customer_name') ?? $user->name,
            'customer_phone' => $request->input('customer_phone') ?? $user->phone,
        ]);
        $validated = $request->validate([
            'customer_name'    => ['required', 'string', 'max:255'],
            'customer_phone'   => ['required', 'string', 'max:20'],
            'shipping_address' => ['required', 'array'],
            'billing_address'  => ['nullable', 'array'],
            'payment_method'   => ['required', 'string', 'in:cod,stripe,khalti,esewa'],
            'customer_note'    => ['nullable', 'string', 'max:500'],
        ]);
        try{
        $orders = $orderService->checkout($request->user(), $validated);
        }
        catch(Throwable $e){
            return response()->json([
                'success' => "failed error occoured",
                'message' => "Order placement failed: ". $e->getMessage(),
                'error' => [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'code' => $e->getCode(),
                ],
            ], 500);
        }
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
    public function requestCancel(Request $request, int $id, OrderService $orderService): JsonResponse
    {
        $request->validate([
            'cancel_reason' => ['required', 'string', 'max:500'],
        ]);

        $order = Order::with('orderItems')
            ->where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        // 1. Check if order can be cancelled
        if (in_array($order->status, ['delivered', 'cancelled', 'returned'])) {
            return response()->json([
                'success' => false,
                'message' => "Order cannot be cancelled because it is already {$order->status}.",
            ], 422);
        }

        if ($order->cancel_status === 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'A cancellation request for this order is already pending shop approval.',
            ], 422);
        }

        // 2. Immediate Cancellation for unpaid COD orders before shipping
        if ($order->payment_method === 'cod' && in_array($order->status, ['pending', 'processing'])) {
            $cancelledOrder = $orderService->cancelOrder($order, $request->cancel_reason);

            return response()->json([
                'success' => true,
                'message' => 'Order cancelled successfully and stock restored.',
                'data'    => $cancelledOrder,
            ]);
        }

        // 3. Prepaid or already Shipped COD orders require Shop Approval
        $order->update([
            'cancel_status'       => 'pending',
            'cancel_reason'       => $request->cancel_reason,
            'cancel_requested_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cancellation request submitted successfully. Waiting for shop approval.',
            'data'    => $order->fresh(),
        ]);
    }
    public function confirmReceived(Request $request, int $id, OrderSettlementService $settlementService): JsonResponse
    {
        $order = Order::with('shop')
            ->where('user_id', $request->user()->id)
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

        DB::transaction(function () use ($order, $settlementService) {
            $order->customer_received_at = now();

            // Auto-mark delivery details upon confirmation
            if ($order->status !== 'delivered') {
                $order->status = 'delivered';
                $order->delivered_at = now();
            }

            // Auto-mark COD payments as paid upon customer confirmation
            if ($order->payment_method === 'cod') {
                $order->payment_status = 'paid';
            }

            $order->save();

            $freshOrder = $order->fresh();

            // Trigger settlement logic when order is marked delivered and paid
            if (
                !$freshOrder->is_credited && 
                $freshOrder->status === 'delivered' && 
                $freshOrder->payment_status === 'paid'
            ) {
                $settlementService->settleOrder($freshOrder);
            }
        });

        if ($order->shop && $order->shop->owner) {
            $order->shop->owner->notify(new OrderStatusUpdatedNotification($order));
        }
        return response()->json([
            'success' => true,
            'message' => 'Order marked as received successfully!',
            'data'    => $order->fresh(),
        ]);
    }
    public function requestReturn(Request $request, $id)
    {
        $request->validate([
            'return_reason' => 'required|string|max:500',
        ]);

        $order = Order::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        // 1. Ensure the order is delivered and hasn't requested a return yet
        if (!$order->canBeReturned()) {
            return response()->json([
                'success' => false,
                'message' => 'This order is not eligible for a return. It must be delivered and have no pending return requests.',
            ], 422);
        }

        // 2. Register return request
        $order->update([
            'return_status'       => 'pending',
            'return_reason'       => $request->return_reason,
            'return_requested_at' => now(),
        ]);

        if ($order->shop && $order->shop->owner) {
            $order->shop->owner->notify(new OrderReturnRequestedNotification($orderReturn));
        }
        // Notify Superadmin
        $admin = User::where('role', 'superadmin')->first();
        if ($admin) {
            $admin->notify(new OrderReturnRequestedNotification($orderReturn));
        }
        return response()->json([
            'success' => true,
            'message' => 'Return request submitted successfully. Waiting for store approval.',
            'data'    => $order->fresh(),
        ]);
    }
}