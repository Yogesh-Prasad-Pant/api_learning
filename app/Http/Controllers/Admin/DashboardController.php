<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Shop;
use App\Models\ShopProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Show Superadmin Control Panel metrics.
     */
    public function superIndex(): JsonResponse
    {
        return response()->json([
            'stats' => [
                'total_admin' => Admin::count(),
                'pending_kyc' => Admin::where('kyc_status', 'pending')->count(),
                'active_now'  => Admin::where('status', 'active')->count(),
                'suspended'   => Admin::where('status', 'suspended')->count(),
            ],
            'quick_links' => [
                'search_admins' => url('/api/admin/list/search'),
            ]
        ]);
    }

    /**
     * Return admin overview & shop contextual details for the logged-in admin.
     */
    public function index(Request $request): JsonResponse
    {
        $admin = $request->user();

        $shops = $admin->shops()
            ->select('id', 'shop_name', 'theme_color', 'admin_id', 'status', 'logo', 'is_open', 'rating', 'balance')
            ->get()
            ->map(function ($shop) {
                $shop->logo = $shop->logo ? asset('storage/' . $shop->logo) : null;
                return $shop;
            });

        $shopCount = $shops->count();

        return response()->json([
            'status'  => 'success',
            'message' => 'Admin Dashboard Data Fetched',
            'data'    => [
                'user' => [
                    'name'        => $admin->name,
                    'email'       => $admin->email,
                    'image'       => $admin->image ? asset('storage/' . $admin->image) : null,
                    'status'      => $admin->status,
                    'kyc'         => $admin->kyc_status,
                    'is_verified' => method_exists($admin, 'canOperate') ? $admin->canOperate() : ($admin->kyc_status === 'verified'),
                ],
                'context' => [
                    'shop_count'        => $shopCount,
                    'has_multi_shop'    => $shopCount >= 2,
                    'shops'             => $shops,
                    'can_add_more_shop' => $shopCount < 3,
                ]
            ]
        ]);
    }

    /**
     * Get aggregate statistics (Revenue, Orders, Low Stock, Balance).
     */
    public function getStats(Request $request): JsonResponse
    {
        $admin = $request->user();
        $shopId = $request->query('shop_id');
        $period = $request->query('period', 'daily');

        // Filter shop IDs belonging exclusively to this admin
        $ownedShopIds = $admin->shops()->pluck('id')->toArray();

        if ($shopId) {
            $shopIds = in_array((int)$shopId, $ownedShopIds) ? [(int)$shopId] : [];
        } else {
            $shopIds = $ownedShopIds;
        }

        $dateFilter = match ($period) {
            'weekly'  => now()->startOfWeek(),
            'monthly' => now()->startOfMonth(),
            default   => now()->startOfDay()
        };

        // Revenue based on vendor earnings from completed/paid orders
        $revenue = Order::whereIn('shop_id', $shopIds)
            ->where('created_at', '>=', $dateFilter)
            ->sum('vendor_earning');

        // Order counts within the specified timeframe
        $ordersCount = Order::whereIn('shop_id', $shopIds)
            ->where('created_at', '>=', $dateFilter)
            ->count();

        // Low stock count from shop_products table
        $lowStock = ShopProduct::whereIn('shop_id', $shopIds)
            ->where('is_available', true)
            ->where('stock', '<=', 5)
            ->count();

        // Current available balance
        $balance = $admin->shops()
            ->when($shopId, fn($q) => $q->where('id', $shopId))
            ->sum('balance');

        return response()->json([
            'status' => 'success',
            'data'   => [
                'revenue'   => number_format((float)$revenue, 2, '.', ''),
                'orders'    => $ordersCount,
                'low_stock' => $lowStock,
                'balance'   => number_format((float)$balance, 2, '.', '')
            ]
        ]);
    }

    /**
     * Get chart sales trends over the last 7 days.
     */
    public function getChartData(Request $request): JsonResponse
    {
        $admin = $request->user();
        $shopId = $request->query('shop_id');

        $shops = $shopId 
            ? $admin->shops()->where('id', $shopId)->get(['id', 'shop_name']) 
            : $admin->shops()->get(['id', 'shop_name']);

        $chartData = [];

        foreach ($shops as $shop) {
            $points = Order::where('shop_id', $shop->id)
                ->where('created_at', '>=', now()->subDays(7))
                ->selectRaw('DATE(created_at) as date, SUM(vendor_earning) as total')
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get();

            $chartData[] = [
                'shop_id'   => $shop->id,
                'shop_name' => $shop->shop_name,
                'points'    => $points
            ];
        }

        return response()->json([
            'status' => 'success',
            'data'   => $chartData
        ]);
    }

    /**
     * Get recent orders list with pagination.
     */
    public function getRecentOrders(Request $request): JsonResponse
    {
        $admin = $request->user();
        $shopId = $request->query('shop_id');
        $ownedShopIds = $admin->shops()->pluck('id');

        $orders = Order::query()
            ->with('shop:id,shop_name')
            ->select('id', 'order_number', 'shop_id', 'total_price', 'vendor_earning', 'status', 'payment_status', 'created_at')
            ->whereIn('shop_id', $ownedShopIds)
            ->when($shopId, fn($q) => $q->where('shop_id', $shopId))
            ->latest()
            ->simplePaginate(10);

        return response()->json([
            'status' => 'success',
            'data'   => $orders
        ]);
    }

    /**
     * Toggle shop status (open/closed).
     */
    public function toggleShopStatus(Request $request, $shop_id): JsonResponse
    {
        $admin = $request->user();
        $shop = $admin->shops()->find($shop_id);

        if (!$shop) {
            return response()->json([
                'status'  => 'failed',
                'is_open' => null,
                'message' => 'Shop not found or unauthorized.'
            ], 404);
        }

        $shop->is_open = !$shop->is_open;
        $shop->save();

        return response()->json([
            'status'  => 'success',
            'is_open' => $shop->is_open,
            'message' => $shop->is_open ? 'Shop is now Open' : 'Shop is now Closed'
        ]);
    }
}