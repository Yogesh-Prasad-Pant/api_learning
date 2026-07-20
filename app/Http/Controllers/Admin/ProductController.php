<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShopProduct;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;
use Exception;

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
            'sale_end'      => 'nullable|date|required_with:sale_start|after:sale_start',
            'local_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if (!$validatedData['product_id'] && !$shopId) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Global asset registration requires superadmin permissions.'
            ], 403);
        }

        $uploadedCatalogImage = null;
        $uploadedLocalImage = null;

        try {
            if (!$request->input('product_id') && $request->hasFile('catalog_image')) {
                $file = $request->file('catalog_image');
                $catFileName = 'catalog_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $uploadedCatalogImage = $file->storeAs('products/catalog', $catFileName, 'public');
            }

            if ($shopId && $request->hasFile('local_image')) {
                $file = $request->file('local_image');
                $tempId = $request->input('product_id') ?? 'new';
                $fileName = 'shop_' . $shopId . '_prod_' . $tempId . '_' . time() . '.' . $file->getClientOriginalExtension();
                $uploadedLocalImage = $file->storeAs('shops/shop_products', $fileName, 'public');
            }
            $result = DB::transaction(function () use($request, $validatedData, $shopId, $uploadedCatalogImage, $uploadedLocalImage)
            {
                $productId = $validatedData['product_id'] ?? null;
                $isNewGlobalProduct = false;
                if(!$productId){
                    $isNewGlobalProduct = true;
                    $product = new Product();
                        $product->shop_id       = $shopId; 
                        $product->category_id   = $validatedData['category_id'];
                        $product->brand_id      = $validatedData['brand_id'];
                        $product->name          = $validatedData['name'];
                        $product->description   = $validatedData['description'] ?? null;
                        $product->video_url     = $validatedData['video_url'] ?? null;
                        $product->has_variants  = $validatedData['has_variants'] ?? false;
                        $product->unit          = $validatedData['unit'];
                        $product->catalog_image = $uploadedCatalogImage;
                        $product->attributes    = $validatedData['attributes'] ?? null;
                        $product->save();
                    $productId = $product->id;
                }
                if($shopId){
                    $exists = ShopProduct::where('shop_id', $shopId)
                    ->where('product_id', $productId)
                    ->exists();

                    if($exists){
                        throw ValidationException::withMessages([
                            'product_id'=>['This catalog item is already listed in shop inventory.']
                        ]);
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
                    $shopProduct->local_image  = $uploadedLocalImage;
                    $shopProduct->save();

                    return [
                        'message' => $isNewGlobalProduct 
                            ? 'Product successfully registered and added to storefront.' 
                            : 'Catalog product successfully added to your storefront.',
                        'data'    => $shopProduct->load('product'),
                    ];
                }

                return [
                    'message' => 'Global master catalog item registered successfully.',
                    'data'    => Product::find($productId),
                ];
            });

            return response()->json([
                'status'  => 'success',
                'message' => $result['message'],
                'data'    => $result['data']
            ], 201);

        }
        catch (ValidationException $e) {
            $this->purgeFiles($uploadedCatalogImage, $uploadedLocalImage);   
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        }
        catch (Exception $e) {
            $this->purgeFiles($uploadedCatalogImage, $uploadedLocalImage);
            return response()->json([
                'status' => 'error',
                 'message' => 'An unexpected server error occourred.'
            ],500);
        }
       
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
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Product inventory record not found.'
                    ], 404);
                }
        try {
             $validatedData = $request->validate([
                    'price'        => 'sometimes|required|numeric|min:0',
                    'sale_price'   => ['nullable', 'numeric', 'min:0',function ($attribute, $value, $fail) use ($request, $shopProduct) {
                                                                            $currentPrice = $request->filled('price') ? $request->input('price') : $shopProduct->price;
                                                                            if (is_numeric($currentPrice) && $value >= $currentPrice) {
                                                                                $fail('The sale price must be less than the regular price.');
                                                                            }
                                                                        }],
                    'stock'        => 'sometimes|required|integer|min:0',
                    'min_order'    => 'integer|min:1',
                    'max_order'    => ['nullable','integer', function ($attribute, $value, $fail) use ($request, $shopProduct) {
                                                                    $minOrder = $request->filled('min_order') ? $request->input('min_order') : $shopProduct->min_order;
                                                                    if (is_numeric($minOrder) && $value <= $minOrder) {
                                                                        $fail('The max order must be greater than the minimum order.');
                                                                    }
                                                                }],
                    'is_available' => 'boolean',
                    'sale_start'   => 'nullable|date',
                    'sale_end'     => 'nullable|date|required_with:sale_start|after:sale_start',
                ]);
            $shopProduct = DB::transaction(function () use ($validatedData, $shopProduct){
                if(array_key_exists('stock', $validatedData)&&(int)$validatedData['stock'] !== (int)$shopProduct->stock){
                    $shopProduct->last_stock_update = now();  
                }
                if ($request->has('price'))         $shopProduct->price = $request->input('price');
                if ($request->has('sale_price'))    $shopProduct->sale_price = $request->input('sale_price');
                if ($request->has('stock'))         $shopProduct->stock = $request->input('stock');
                if ($request->has('min_order'))     $shopProduct->min_order = $request->input('min_order');
                if ($request->has('max_order'))     $shopProduct->max_order = $request->input('max_order');
                if ($request->has('is_available'))  $shopProduct->is_available = $request->input('is_available');
                if ($request->has('sale_start'))    $shopProduct->sale_start = $request->input('sale_start');
                if ($request->has('sale_end'))      $shopProduct->sale_end = $request->input('sale_end');
                $shopProduct->save();
                return $shopProduct;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Inventory changes saved successfully.',
                'data' => $shopProduct
            ]);
        }   catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        }   catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected server error occurred during update.'
            ], 500);
        }
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
            $oldImage = $shopProduct->local_image;
    
            $file= $request->file('local_image');
            $fileName = 'shop_' . $shopId . '_prod_' . $product_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('shops/shop_products', $fileName, 'public');
            $shopProduct->local_image = $path;
            $shopProduct->save();

            if ($oldImage) {
                $this->purgeFiles($oldImage);
            }
            return response()->json([
                'status'    => 'success',
                'message'   => 'Storefront product image asset updated.',
                'image_url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['message' => 'File transfer error.'], 400);
    }
    /**
     * Update the global catalog master image asset.
     * Accessible only if the product belongs to the global catalog pool 
     * or is authorized under your platform's master-catalog rules.
     */
    public function updateCatalogImage(Request $request, $product_id)
    {
        $shop = $request->active_shop;
        $shopId = $shop ? $shop->id : null;

        $product = Product::find($product_id);

        if (!$product) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Global catalog product record not found.'
            ], 404);
        }

        // CORRECTED GUARD: Allow superadmin (where shop_id and $shopId are both null)
        if ($product->shop_id !== null && $product->shop_id !== $shopId) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized. You cannot modify a master catalog asset owned by another entity.'
            ], 403);
        }

        // If it's a global asset (shop_id is null) but a regular merchant ($shopId is set) tries to touch it:
        if ($product->shop_id === null && $shopId !== null) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized. Only platform superadmins can modify global master catalog assets.'
            ], 403);
        }

        $request->validate([
            'catalog_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('catalog_image')) {
            $oldImage = $product->catalog_image;
            $file = $request->file('catalog_image');
            $catFileName = 'catalog_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $path = $file->storeAs('products/catalog', $catFileName, 'public');
            $product->catalog_image = $path;
            $product->save();

            if ($oldImage) {
                $this->purgeFiles($oldImage);
            }

            return response()->json([
                'status'    => 'success',
                'message'   => 'Global master catalog image asset updated.',
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

        if ($shopProduct->local_image) {
            $this->purgeFiles($shopProduct->local_image);
        }


        $shopProduct->forceDelete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product and associated files have been permanently purged.'
        ]);
    }

    private function purgeFiles(...$files)
    {
        foreach ($files as $file) {
            if ($file && Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }
    }
    
}
