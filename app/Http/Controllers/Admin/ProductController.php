<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShopProduct;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
        $shopId = $request->active_shop_id;

        $validatedData = $request->validate([
            'product_id'   => 'required|exists:products,id',
            'price'        => 'required|numeric|min:0',
            'sale_price'   => 'nullable|numeric|min:0|lt:price',
            'stock'        => 'required|integer|min:0',
            'min_order'    => 'integer|min:1',
            'max_order'    => 'nullable|integer|gt:min_order',
            'is_available' => 'boolean',
            'sale_start'   => 'nullable|date',
            'sale_end'     => 'nullable|date|after:sale_start'
        ]);

        $validatedData['shop_id'] = $shopId;

        $exists = ShopProduct::where('shop_id', $shopId)
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'status'  => 'error',
                'message' => 'This catalog item is already listed in your inventory.'
            ], 409);
        }

        $validatedData['last_stock_update'] = now();

        $shopProduct = ShopProduct::create($validatedData);

        return response()->json([
            'status'  => 'success',
            'message' => 'Product successfully added to your store catalog.',
            'data'    => $shopProduct->load('product')
        ], 201);
    }

    public function index(Request $request)
    {
        $shopId = $request->active_shop_id;
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
        $shopId = $request->active_shop_id;

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
        $shopId = $request->active_shop_id;

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
            'sale_price'   => 'nullable|numeric|min:0|lt:{$currentPrice}',
            'stock'        => 'sometimes|required|integer|min:0',
            'min_order'    => 'integer|min:1',
            'max_order'    => 'nullable|integer|gt:{$currentMinOrder}',
            'is_available' => 'boolean',
            'sale_start'   => 'nullable|date',
            'sale_end'     => 'nullable|date'
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
        $shopId = $request->active_shop_id;

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
            $path = $request->file('local_image')->store('shop_products', 'public');
            
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
        $shopId = $request->active_shop_id;

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
        $shopId = $request->active_shop_id;

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
