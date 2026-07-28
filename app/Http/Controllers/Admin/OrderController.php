<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private function applyShopScope(Builder $query, Request $request, $admin): Builder
    {
        if ($admin->is_superadmin && !$request->has('active_shop')) {
            return $query;
        }

        $activeShop = $request->get('active_shop');

        if ($activeShop) {
            return $query->where('shop_id', $activeShop->id);
        }

        return $query->whereRaw('1 = 0');
    }

    public function index(Request $request): JsonResponse
    {
        $admin = auth('admin')->user();

        $orders = Order::with(['user:id,name,email', 'orderItems'])
            ->when($admin, fn($q) => $this->applyShopScope($q, $request, $admin))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15);

        return response()->json($orders);
    }

    public function show(Request $request, string|int $id): JsonResponse
    {
        $admin = auth('admin')->user();

        $order = Order::with(['user:id,name,email,phone', 'orderItems', 'shop:id,shop_name'])
            ->when($admin, fn($q) => $this->applyShopScope($q, $request, $admin))
            ->findOrFail($id);

        return response()->json($order);
    }

    public function updateStatus(Request $request, string|int $id): JsonResponse
    {
        $validated = $request->validate([
            'status'          => 'nullable|string|in:pending,processing,shipped,delivered,cancelled',
            'payment_status'  => 'nullable|string|in:pending,paid,failed,refunded',
            'tracking_number' => 'nullable|string|max:255',
            'admin_note'      => 'nullable|string|max:500',
        ]);

        $admin = auth('admin')->user();

        $query = Order::query();
        $query = $this->applyShopScope($query, $request, $admin);

        $order = $query->findOrFail($id);

        // Handle timestamp side-effects for status changes
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
            'order'   => $order->fresh(['user:id,name,email', 'orderItems']),
        ]);
    }
}