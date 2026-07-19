<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShopProduct;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
  
    private function hasBeenOrdered($shopId, $product_id)
    {
        return OrderItem::where('shop_id', $shopId)
            ->where('product_id', $product_id)
            ->exists();
    }
    public function store(Request $request)
    {
        $shop = $request->active_shop;
        $shopId = $shop ? $shop->id : null;

        $validatedData = $request->validate([
           'product_id'    => 'nullable|required_without:name|exists:products,id',
            
            // Specifications for constructing a brand new base item
            'name'          => 'nullable|required_without:product_id|string|max:255',
            'category_id'   => 'required_if:product_id,null|exists:categories,id',
            'brand_id'      => 'required_if:product_id,null|exists:brands,id',
            'description'   => 'nullable|string',
            'video_url'     => 'nullable|url',
            'has_variants'  => 'boolean',
            'unit'          => 'required_if:product_id,null|string|max:50',
            'catalog_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'attributes'    => 'nullable|array',

            // Local storefront parameters (Mandatory if working within an active shop scope)
            'price'         => 'required|numeric|min:0',
            'sale_price'    => 'nullable|numeric|min:0|lt:price',
            'stock'         => 'required|integer|min:0',
            'min_order'     => 'integer|min:1',
            'max_order'     => 'nullable|integer|gt:min_order',
            'is_available'  => 'boolean',
            'sale_start'    => 'nullable|date',
            'sale_end'      => 'nullable|date|after:sale_start',
            'local_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $result = DB::transaction(function () use($request, $validatedData, $shopId)
        {
            $productId = $validatedData['product_id'] ?? null;
            $isNewGlobalProduct = false;
            if(!$productId){
                $isNewGlobalProduct = true;
                if($request->hasFile('catalog_image')) {
                    $file = $request->file('catalog_image');
                    $catFileName = 'catalog_'.time() .'_' . uniqid(). '.' . $file->getClientOriginalExtension();
                    $validatedData['catalog_image'] = $file->storeAs('products/catalog', $catFileName, 'public');
                }
                $product = new Product();
                    $product->shop_id       = $shopId; 
                    $product->category_id   = $validatedData['category_id'];
                    $product->brand_id      = $validatedData['brand_id'];
                    $product->name          = $validatedData['name'];
                    $product->description   = $validatedData['description'] ?? null;
                    $product->video_url     = $validatedData['video_url'] ?? null;
                    $product->has_variants  = $validatedData['has_variants'] ?? false;
                    $product->unit          = $validatedData['unit'];
                    $product->catalog_image = $validatedData['catalog_image'] ?? null;
                    $product->attributes    = $validatedData['attributes'] ?? null;
                    $product->save();
                $productId = $product->id;
            }
            if($shopId){
                $exists = ShopProduct::where('shop_id', $shopId)
                ->where('product_id', $productId)
                ->exists();

                if($exists){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'This catalog item is already listed in this shop intventory'
                    ],409);
                }

                $localImagePath = null;
                if($request->hasFile('local_image')){
                    $file = $request->file('local_image');
                    $fileName = 'shop_' . $shopId . '_prod_' . $productId. '_' . time() . '.' . $file->getClientOriginalExtension();
                    $localImagePath = $file->storeAs('shops/shop_products',  $fileName, 'public');
                }
                $shopProduct = new ShopProduct();
                
                $shopProduct->shop_id      = $shopId;
                $shopProduct->product_id   = $productId;
                $shopProduct->price        = $validatedData['price'];
                $shopProduct->sale_price   = $validatedData['sale_price'] ?? null;
                $shopProduct->stock        = $validatedData['stock'];
                $shopProduct->min_order    = $validatedData['min_order'] ?? 1;
                $shopProduct->max_order    = $validatedData['max_order'] ?? null;
                $shopProduct->is_available = $validatedData['is_available'] ?? true;
                $shopProduct->sale_start   = $validatedData['sale_start'] ?? null;
                $shopProduct->sale_end     = $validatedData['sale_end'] ?? null;
                $shopProduct->local_image  = $localImagePath;

                $shopProduct->save();
                return [
                    'success' => true,
                    'message' => $isNewGlobalProduct 
                        ? 'Product successfully registered and added to storefront.' 
                        : 'Catalog product successfully added to your storefront.',
                    'data'    => $shopProduct->load('product'),
                    'code'    => 201
                ];
            }

            return [
                'success' => true,
                'message' => 'Global master catalog item registered successfully.',
                'data'    => Product::find($productId),
                'code'    => 201
            ];
        });
        if (isset($result['error'])) {
            return response()->json([
                'status'  => 'error',
                'message' => $result['error']
            ], $result['code']);
        }

        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
            'data'    => $result['data']
        ], $result['code']);

       
    }

    public function index(Request $request)
    {
        $shopId = $request->active_shop->id;
        $shopProducts = ShopProduct::with('product')
            ->where('shop_id', $shopId)
            ->get();

        return response()->json([
            'status' => 'success',
            'count'  => $shopProducts->count(),
            'data'   => $shopProducts
        ]);
    }

    public function getProduct(Request $request,$product_id)
    {
        $shopId = $request->active_shop->id;

        $shopProduct = ShopProduct::with('product')
            ->where('shop_id', $shopId)
            ->where('product_id', $product_id)
            ->first();

        if (!$shopProduct) {
            return response()->json(['message' => 'Product inventory record not found.'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $shopProduct
        ]);
    }

    public function updateProduct(Request $request, $product_id)
    {
        $shopId = $request->active_shop->id;

        $shopProduct = ShopProduct::where('shop_id', $shopId)
            ->where('product_id', $product_id)
            ->first();

        if (!$shopProduct) {
            return response()->json(['message' => 'Product inventory record not found.'], 404);
        }
        $currentPrice = $request->input('price', $shopProduct->price);
        $currentMinOrder = $request->input('min_order', $shopProduct->min_order);
        $validatedData = $request->validate([
            'price'        => 'sometimes|required|numeric|min:0',
            'sale_price'   => "nullable|numeric|min:0|lt:{$currentPrice}",
            'stock'        => 'sometimes|required|integer|min:0',
            'min_order'    => 'integer|min:1',
            'max_order'    => "nullable|integer|gt:{$currentMinOrder}",
            'is_available' => 'boolean',
            'sale_start'   => 'nullable|date',
            'sale_end'     => 'nullable|date|after:sale_start',
        ]);
        if(array_key_exists('stock', $validatedData)&&(int)$validatedData['stock'] !== (int)$shopProduct->stock){
            $validatedData['last_stock_update'] = now();  
        }
        $shopProduct->update($validatedData);

        return response()->json([
            'status'  => 'success',
            'message' => 'Inventory changes saved successfully.',
            'data'    => $shopProduct
        ]);
    }

    public function updateProductImage(Request $request, $product_id)
    {
        $shopId = $request->active_shop->id;

        $shopProduct = ShopProduct::where('shop_id', $shopId)
            ->where('product_id', $product_id)
            ->first();

        if (!$shopProduct) {
            return response()->json(['message' => 'Product records not found.'], 404);
        }

        $request->validate([
            'local_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('local_image')) {
            if($shopProduct->local_image && Storage::disk('public')->exists($shopProduct->local_image)){
                Storage::disk('public')->delete($shopProduct->local_image);
            }
            $file= $request->file('local_image');
            $fileName = 'shop_' . $shopId . '_prod_' . $product_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('shops/shop_products', $fileName, 'public');
            
            $shopProduct->update([
                'local_image' => $path
            ]);

            return response()->json([
                'status'    => 'success',
                'message'   => 'Storefront product image asset updated.',
                'image_url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['message' => 'File transfer error.'], 400);
    }

    
    public function deleteProduct(Request $request, $product_id)
    {
        $shopId = $request->active_shop->id;

        $shopProduct = ShopProduct::where('shop_id', $shopId)
            ->where('product_id', $product_id)
            ->first();

        if (!$shopProduct) {
            return response()->json(['message' => 'Product record not found.'], 404);
        }

        $shopProduct->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Product has been safely archived from your storefront display.'
        ]);
    }
    public function forceDeleteProduct(Request $request, $product_id)
    {
        $shopId = $request->active_shop->id;

        $shopProduct = ShopProduct::withTrashed()
            ->where('shop_id', $shopId)
            ->where('product_id', $product_id)
            ->first();

        if (!$shopProduct) {
            return response()->json(['message' => 'Product record not found.'], 404);
        }

        if ($this->hasBeenOrdered($shopId, $product_id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot permanently delete this item because it has order history associated with it. Please use regular delete instead.'
            ], 422);
        }

        if ($shopProduct->local_image && Storage::disk('public')->exists($shopProduct->local_image)) {
            Storage::disk('public')->delete($shopProduct->local_image);
        }


        $shopProduct->forceDelete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product and associated files have been permanently purged.'
        ]);
    }
    
}
