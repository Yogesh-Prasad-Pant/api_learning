<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
   
    public function index(Request $request): AnonymousResourceCollection
    {
        $orders = Order::forShop()
            ->with(['user:id,name,email', 'orderItems'])
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
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

 
    public function updateStatus(Request $request, string|int $id): JsonResponse
    {
        $validated = $request->validate([
            'status'          => 'nullable|string|in:pending,processing,shipped,delivered,cancelled',
            'payment_status'  => 'nullable|string|in:pending,paid,failed,refunded',
            'tracking_number' => 'nullable|string|max:255',
            'admin_note'      => 'nullable|string|max:500',
        ]);

        $order = Order::forShop()->findOrFail($id);

        $this->authorize('update', $order);
        if (isset($validated['status'])) {
            if ($validated['status'] === 'delivered' && !$order->delivered_at) {
                $validated['delivered_at'] = now();
            } elseif ($validated['status'] === 'cancelled' && !$order->cancelled_at) {
                $validated['cancelled_at'] = now();
            }
        }

        $order->update($validated);

        return response()->json([
            'message' => 'Order status updated successfully.',
            'order'   => new OrderResource($order->fresh(['user:id,name,email', 'orderItems', 'shop:id,shop_name'])),
        ]);
    }
}