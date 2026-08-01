<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderSettlementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $orders = Order::forShop()
            ->with(['user:id,name,email', 'orderItems'])
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('cancel_status'), fn($q) => $q->where('cancel_status', $request->cancel_status))
            ->latest()
            ->paginate(15);

        return OrderResource::collection($orders);
    }

    public function show(string|int $id): OrderResource
    {
        $order = Order::forShop()
            ->with(['user:id,name,email,phone', 'orderItems', 'shop:id,shop_name'])
            ->findOrFail($id);

        $this->authorize('view', $order);

        return new OrderResource($order);
    }
    public function updateStatus(Request $request, string|int $id, OrderSettlementService $settlementService): JsonResponse
    {
        $validated = $request->validate([
            'status'             => 'nullable|string|in:pending,processing,shipped,delivered,cancelled,returned',
            'payment_status'     => 'nullable|string|in:unpaid,paid,partially_refunded,refunded',
            'tracking_number'    => 'nullable|string|max:255',
            'admin_note'         => 'nullable|string|max:500',
            'delivery_type'      => 'nullable|string|in:shop_self,platform_courier,third_party',
            'courier_name'       => 'nullable|string|max:255',
            'courier_waybill_id' => 'nullable|string|max:255',
        ]);

        $order = Order::forShop()->with(['orderItems', 'shop'])->findOrFail($id);

        $this->authorize('update', $order);

        DB::transaction(function () use ($order, $validated, $settlementService) {
            $oldStatus = $order->status;

            if (isset($validated['status'])) {
                if ($validated['status'] === 'delivered' && !$order->delivered_at) {
                    $validated['delivered_at'] = now();

                    // Auto-mark COD orders as paid upon delivery
                    if ($order->payment_method === 'cod') {
                        $validated['payment_status'] = 'paid';
                    }
                } elseif ($validated['status'] === 'cancelled' && !$order->cancelled_at) {
                    $validated['cancelled_at'] = now();

                    // Restock inventory if order wasn't previously cancelled
                    if ($oldStatus !== 'cancelled') {
                        $this->restockOrderItems($order);
                    }
                }
            }

            $order->update($validated);
            $freshOrder = $order->fresh();

            // Trigger settlement only if the order is delivered & paid, and hasn't been credited yet
            if (
                !$freshOrder->is_credited &&
                $freshOrder->status === 'delivered' &&
                $freshOrder->payment_status === 'paid'
            ) {
                $settlementService->settleOrder($freshOrder);
            }
        });

        return response()->json([
            'message' => 'Order status updated successfully.',
            'order'   => new OrderResource($order->fresh(['user:id,name,email', 'orderItems', 'shop:id,shop_name'])),
        ]);
    }
    public function approveCancellation(Request $request, string|int $id): JsonResponse
    {
        $order = Order::forShop()->with('orderItems')->findOrFail($id);

        $this->authorize('update', $order);

        if ($order->cancel_status !== 'pending') {
            return response()->json([
                'message' => 'No pending cancellation request found for this order.',
            ], 422);
        }

        DB::transaction(function () use ($order, $request) {
            $updateData = [
                'status'        => 'cancelled',
                'cancel_status' => 'approved',
                'cancelled_at'  => now(),
            ];

            if ($request->filled('admin_note')) {
                $updateData['admin_note'] = $request->admin_note;
            }

            // Handle Prepaid Refunds (eSewa, Khalti, Stripe)
            if ($order->payment_status === 'paid' && $order->payment_method !== 'cod') {
                $updateData['payment_status'] = 'refunded';
            }

            // Restock products back to inventory
            $this->restockOrderItems($order);

            $order->update($updateData);
        });

        return response()->json([
            'message' => 'Order cancellation approved successfully and stock restored.',
            'order'   => new OrderResource($order->fresh(['user:id,name,email', 'orderItems', 'shop:id,shop_name'])),
        ]);
    }
    public function rejectCancellation(Request $request, string|int $id): JsonResponse
    {
        $request->validate([
            'admin_note' => 'required|string|max:500', // Reason for rejecting cancellation
        ]);

        $order = Order::forShop()->findOrFail($id);

        $this->authorize('update', $order);

        if ($order->cancel_status !== 'pending') {
            return response()->json([
                'message' => 'No pending cancellation request found for this order.',
            ], 422);
        }

        $order->update([
            'cancel_status' => 'rejected',
            'admin_note'    => $request->admin_note,
        ]);

        return response()->json([
            'message' => 'Cancellation request rejected. Order will proceed with fulfillment.',
            'order'   => new OrderResource($order->fresh(['user:id,name,email', 'orderItems', 'shop:id,shop_name'])),
        ]);
    }
    public function processReturn(Request $request, string|int $id, OrderSettlementService $settlementService): JsonResponse
    {
        $validated = $request->validate([
            'status'     => ['required', 'string', 'in:approved,rejected'],
            'admin_note' => ['nullable', 'string', 'max:500'],
        ]);

        // Scoped to the vendor's shop + authorization
        $order = Order::forShop()->with('orderItems')->findOrFail($id);

        $this->authorize('update', $order);

        // 1. Verify that a return request is actually pending
        if ($order->return_status !== 'pending') {
            return response()->json([
                'message' => 'This order does not have a pending return request.',
            ], 422);
        }

        // 2. Handle Rejection
        if ($validated['status'] === 'rejected') {
            $order->update([
                'return_status' => 'rejected',
                'admin_note'    => $validated['admin_note'] ?? $order->admin_note,
            ]);

            return response()->json([
                'message' => 'Return request has been rejected.',
                'order'   => new OrderResource($order->fresh(['user:id,name,email', 'orderItems', 'shop:id,shop_name'])),
            ]);
        }

        // 3. Handle Approval (Triggers financial reversal and restocks items)
        $order->update([
            'return_status' => 'approved',
            'admin_note'    => $validated['admin_note'] ?? $order->admin_note,
        ]);

        // Reverse shop earnings (if credited) & restore inventory
        $settlementService->refundOrder($order);

        return response()->json([
            'message' => 'Return request approved. Order marked as returned, payment status updated to refunded, and stock restored.',
            'order'   => new OrderResource($order->fresh(['user:id,name,email', 'orderItems', 'shop:id,shop_name'])),
        ]);
    }
    private function restockOrderItems(Order $order): void
    {
        foreach ($order->orderItems as $item) {
            if ($item->product_id) {
                Product::where('id', $item->product_id)->increment('stock', $item->quantity);
            }
        }
    }
}