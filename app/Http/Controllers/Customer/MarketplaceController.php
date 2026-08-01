<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    /**
     * Global product discovery feed using model relationships & custom scopes.
     * Route: GET /api/v1/marketplace/products
     */
    public function index(Request $request): JsonResponse
    {
        $userLat = $request->query('latitude');
        $userLng = $request->query('longitude');

        // Query ShopProduct pivot records directly
        $query = ShopProduct::with([
            'product' => function ($q) {
                $q->select('id', 'category_id', 'brand_id', 'name', 'slug', 'catalog_image')
                  ->with(['category:id,name,slug', 'brand:id,name,slug,logo']);
            },
            'shop' => fn($q) => $q->select('id', 'shop_name', 'slug', 'logo', 'rating', 'address', 'latitude', 'longitude', 'is_open'),
        ])
        ->where('is_available', true)
        ->where('stock', '>', 0);

        // 1. Keyword search (Product name, description, or Shop name)
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('product', function ($p) use ($keyword) {
                    $p->where('name', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
                })
                ->orWhereHas('shop', function ($s) use ($keyword) {
                    $s->where('shop_name', 'like', "%{$keyword}%");
                });
            });
        }

        // 2. Category & Brand filters
        if ($request->filled('category_id')) {
            $query->whereHas('product', fn($q) => $q->where('category_id', $request->category_id));
        }

        if ($request->filled('brand_id')) {
            $query->whereHas('product', fn($q) => $q->where('brand_id', $request->brand_id));
        }

        // 3. Filtering by location using Shop::scopeNear
        if ($userLat && $userLng) {
            $radius = $request->get('radius', 10);
            $query->whereHas('shop', function ($s) use ($userLat, $userLng, $radius) {
                $s->near($userLat, $userLng, $radius);
            });
        }

        // 4. Sorting logic
        switch ($request->get('sort')) {
            case 'cheapest':
                $query->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'expensive':
                $query->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            default:
                $query->latest('id');
                break;
        }

        $products = $query->paginate($request->get('per_page', 20));

        // Append the effective_price accessor to every item
        $products->getCollection()->each(function ($item) {
            $item->append('effective_price');
        });

        return response()->json([
            'success' => true,
            'data'    => $products,
        ]);
    }
}
