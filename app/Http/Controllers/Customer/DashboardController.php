<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ShopProduct; // Or your Saved/Wishlist model if applicable
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get aggregate profile statistics and recent activity for the customer.
     * Route: GET /api/v1/customer/dashboard
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        // 1. Order Statistics
        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'processing'])
            ->count();
        $completedOrders = Order::where('user_id', $user->id)
            ->where('status', 'delivered')
            ->count();

        // Total amount spent on completed orders
        $totalSpent = Order::where('user_id', $user->id)
            ->where('status', 'delivered')
            ->sum('grand_total');

        // 2. Recent Orders (Latest 5)
        $recentOrders = Order::with(['items.shopProduct.product:id,name,catalog_image'])
            ->where('user_id', $user->id)
            ->latest('id')
            ->take(5)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Customer dashboard retrieved successfully.',
            'data'    => [
                'user' => [
                    'id'         => $user->id,
                    'name'       => $user->name,
                    'email'      => $user->email,
                    'phone'      => $user->phone ?? null,
                    'avatar'     => $user->avatar ?? null,
                    'joined_at'  => $user->created_at->format('Y-m-d'),
                ],
                'stats' => [
                    'total_orders'     => $totalOrders,
                    'pending_orders'   => $pendingOrders,
                    'completed_orders' => $completedOrders,
                    'total_spent'      => round($totalSpent, 2),
                ],
                'recent_orders' => $recentOrders,
            ],
        ]);
    }

    /**
     * Get paginated customer order history with filters.
     * Route: GET /api/v1/customer/orders
     */
    public function orderHistory(Request $request): JsonResponse
    {
        $user = $request->user();

        $orders = Order::with([
            'items' => function ($q) {
                $q->with([
                    'shop:id,shop_name,slug,logo',
                    'shopProduct.product:id,name,catalog_image',
                ]);
            },
        ])
        ->where('user_id', $user->id)
        ->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        })
        ->latest('id')
        ->paginate($request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'message' => 'Order history retrieved.',
            'data'    => $orders,
        ]);
    }

    /**
     * Get single order details for tracking and invoice view.
     * Route: GET /api/v1/customer/orders/{order_number}
     */
    public function orderDetails(Request $request, string $orderNumber): JsonResponse
    {
        $user = $request->user();

        $order = Order::with([
            'items.shop:id,shop_name,slug,logo,contact_no,address',
            'items.shopProduct.product:id,name,catalog_image,unit',
        ])
        ->where('user_id', $user->id)
        ->where('order_number', $orderNumber)
        ->firstOrFail();

        return response()->json([
            'success' => true,
            'message' => 'Order details retrieved.',
            'data'    => $order,
        ]);
    }
}