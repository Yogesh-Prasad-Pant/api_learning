<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    /**
     * Get single shop profile details and active shop products.
     * Route: GET /api/v1/shops/{slug}
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        // 1. Fetch active shop profile using exact model attributes
        $shop = Shop::where('slug', $slug)
            ->firstOrFail([
                'id',
                'admin_id',
                'shop_name',
                'slug',
                'description',
                'logo',
                'cover_image',
                'theme_color',
                'business_email',
                'contact_no',
                'address',
                'map_location',
                'latitude',
                'longitude',
                'is_open',
                'opening_hours',
                'rating',
                'reviews_count',
                'social_links',
                'meta_title',
                'meta_description',
            ]);

        // 2. Base query using ShopProduct model relationships
        $query = ShopProduct::with([
            'product' => function ($q) {
                $q->select('id', 'category_id', 'brand_id', 'name', 'slug', 'unit', 'catalog_image')
                  ->with([
                      'category:id,name,slug',
                      'brand:id,name,slug,logo',
                      'images:id,product_id,image_path,sort_order'
                  ]);
            },
        ])
        ->where('shop_id', $shop->id)
        ->where('is_available', true)
        ->where('stock', '>', 0);

        // 3. Search within this shop by product name or SKU
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // 4. Filter by category
        if ($request->filled('category_id')) {
            $categoryId = $request->category_id;
            $query->whereHas('product', fn($q) => $q->where('category_id', $categoryId));
        }

        // 5. Featured / On Sale products
        $saleProducts = (clone $query)
            ->whereNotNull('sale_price')
            ->where('sale_price', '>', 0)
            ->take(6)
            ->get()
            ->each(fn($sp) => $sp->append('effective_price'));

        // 6. Paginated shop inventory
        $products = $query->latest('id')->paginate(16);
        $products->getCollection()->each(fn($sp) => $sp->append('effective_price'));

        return response()->json([
            'success' => true,
            'message' => 'Shop storefront retrieved successfully.',
            'data'    => [
                'branding' => [
                    'theme_color' => $shop->theme_color ?? '#4A90E2',
                    'logo'        => $shop->logo,
                    'cover_image' => $shop->cover_image,
                ],
                'shop'          => $shop,
                'sale_products' => $saleProducts,
                'products'      => $products,
            ],
        ]);
    }
}