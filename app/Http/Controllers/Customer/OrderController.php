<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}