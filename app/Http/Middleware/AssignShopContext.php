<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AssignShopContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $shopId = $request->header('X-Shop-Id');
        if(!$shopId) {
            return response()->json([
                'status' => 'error',
                'messge' => 'Missing shop context. Please select a shop first.'
            ],422);
        }

        $ownsShop = Auth::user()->shops()->where('id', $shpId)->exists();
            if(!$ownsShop){
                return response()->json([
                    'status' => 'eroor',
                    'message' => 'Unauthorized access request to this shop environment.'
                ], 403);
            }
        $request->attribute->set('active_shop_id', (int) $shopId);
        return $next($request);
    }
}
