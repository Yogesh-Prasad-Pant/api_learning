<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use Carborn\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{   
    //function to show superadmin control pannel
    public function superIndex()
    {
        return response()->json([
            'stats' => [
                'total_admin' => Admin::count(),
                'pending_kyc' => Admin::where('kyc_status','pending')->count(),
                'active_now' => Admin::where('status', 'active')->count(),
                'suspended' => Admin::where('status', 'suspended')->count(),
            ],
            'quick_links'=>[
                'search_admins' => url('/api/admin/list/search'),
            ]
        ]);

    }
    //function to return detail to logined user or dasboard
    public function index(Request $request)
    {
        $admin = $request->user();
        $shops = $admin->shops()
            ->select('id','shop_name','theme_color', 'admin_id', 'status', 'logo')
            ->get()
            ->map(function($shop){
                $shop->logo = $shop->logo ? asset('storage/' . $shop->logo) : null;
                return $shop;
            });

        $shopCount = $shops->count();

        return response()->json([
            'status' => 'success',
            'message' => 'Admin Dashboard Data Fetched',
            'data' => [
                'user' => [
                    'name' => $admin->name,
                    'email'=> $admin->email,
                    'image' => $admin->image ? asset('storage/' . $admin->image) : null,
                    'status' => $admin->status,
                    'kyc' => $admin->kyc_status,
                    'is_verified' => $admin->canOperate(),
                ],
                'context' => [
                    'shop_count' => $shopCount,
                    'has_multi_shop' => $shopCount >=2,
                    'shops' => $shops,
                    'can_add_more_shop' => $shopCount < 3,
                ]
            ]
        ]);
    }

    public function getStats(Request $request)
    {
        $admin = auth('admin')->user();
        $shoopId = $request->query('shop_id');
        $period = $request->query('period', 'daily');
        $shopIds = $shopId?[$shopId]:$admin->shops()->pluck('id');
        $dataFilter = match($period) {
            'weekly' => now()->startOfWeek(), 
            'monthly'=> now()->startOfMonth(),
            default=>now()->startOfDay()
        };
        $revenue = Order::whereIn('shop_id', $shopIds)
            ->where('created_at','>=', $dateFilter)
            ->sum('total_price');
        $ordersCount = Order::whereIn('shop_id', $shopIds)
            ->where('created_at', '>=', $dateFilter)->count();
        $lowStock = Product::whereIn('shop_id', $shopIds)
            ->where('stock','<=',5)->count();
        $balance = $admin->shops()
            ->when($shopId, fn($q)=> $q->where('id',$shopId))
            ->sum('balance');
        return response()->json(['revenue' => number_format($revenue,2), 
            'orders' => $ordersCount,
            'low_stock' => $lowStock,
            'balance' => number_format($balance,2)
            ]);
    }

    public function getChartData(Request $request)
    {
        $admin = auth('admin')->user();
        $shopId = $request->query('shop_id');
        $shops = $shopId? $admin->shops()->where('id', $shopId)->get(['id','name']):$admin->shops()->get(['id','name']);
        $chartData = [];
        foreach($shops as $shop){
            $points = Order::where('shop_id', $shop->id)
                ->where('created_at','>=',now()->subDays(7))
                ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
                ->groupBy('date')->orderBy('date','ASC')
                ->get();
            $chartData[] = ['shop_name' => $shop_name, 'points' => $points];
        }
        return response()->json($chartData);
    } 

    public function getRecentOrders(Request $request)
    {
        $admin = auth('admin')->user();
        $shopId = $request->query('shop_id');
        $ownedShopIds = $admin->shops()->pluck('id');
        $orders = Order::query()->with('shop:id, name')
            ->select('id','shop_id','toal_price', 'status', 'created_at')
            ->whereIn('shop_id',$ownedShopsIds)
            ->when($shopId, fn($q)=> $q->where('shop_id',$shopId))
            ->latest()->simplePaginate(10);
        return response()->json($orders);
    }
    
    
}
