<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use App\Models\ShopProduct;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        $hasProductId = $request->filled('product_id');

        $user = $request->user();
        $isSuperAdmin = $user && $user->role === 'super_admin';
        $isActive = $user && $user->status === 'active';

        $validatedData = $request->validate([
            'product_id'    => 'nullable|exists:products,id',
            
            // Base catalog specifications (Required if creating a new global product)
            'name'          => 'required_without:product_id|nullable|string|max:255',
            'category_id'   => 'required_without:product_id|nullable|exists:categories,id',
            'brand_id'      => 'required_without:product_id|nullable|exists:brands,id',
            'unit'          => 'required_without:product_id|nullable|string|max:50',
            'description'   => 'nullable|string',
            'video_url'     => 'nullable|url',
            'has_variants'  => 'boolean',
            'catalog_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'attributes'    => 'nullable|array',

            // Local storefront parameters (Required if attached to a shop)
            'price'         => $shopId ? 'required|numeric|min:0' : 'nullable|numeric|min:0',
            'stock'         => $shopId ? 'required|integer|min:0' : 'nullable|integer|min:0',
            'sale_price'    => 'nullable|numeric|min:0|lt:price',
            'min_order'     => 'integer|min:1',
            'max_order'     => 'nullable|integer|gt:min_order',
            'is_available'  => 'boolean',
            'sale_start'    => 'nullable|date',
            'sale_end'      => 'nullable|date|required_with:sale_start|after:sale_start',
            'local_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $uploadedCatalogImage = null;
        $uploadedLocalImage = null;

        try {
            // CASE 1: SUPERADMIN REGISTERING A GLOBAL CATALOG PRODUCT ONLY
            
            if ($isSuperAdmin && !$shopId) {
                if ($request->hasFile('catalog_image')) {
                    $uploadedCatalogImage = $request->file('catalog_image')->store('products/catalog', 'public');
                }
                
                $product = new Product();
                $product->shop_id       = null;
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

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Global master catalog item registered successfully.',
                    'data'    => $product
                ], 201);
            }
            // CASE 2: NORMAL ADMIN/SHOP ATTACHING AN EXISTING GLOBAL PRODUCT
            else if ($shopId && $hasProductId) {

                if (!$isActive) {
                    $localCount = ShopProduct::where('shop_id', $shopId)->count();
                    if ($localCount >= 200) {
                        return response()->json([
                            'status'  => 'error',
                            'message' => 'Your account is inactive and has reached the limit of 200 linked products. Please contact the platform owner or super admin to activate your account.'
                        ], 403);
                    }
                }

                $productId = $validatedData['product_id'];

                $alreadyExists = ShopProduct::where('shop_id', $shopId)
                    ->where('product_id', $productId)
                    ->exists();

                if ($alreadyExists) {
                    throw ValidationException::withMessages([
                        'product_id' => ['This catalog item is already listed in your shop inventory.']
                    ]);
                }

                if ($request->hasFile('local_image')) {
                    $uploadedLocalImage = $request->file('local_image')->store('shops/shop_products', 'public');
                }
                $shopProduct = new ShopProduct();
                $shopProduct->shop_id      = $shopId;
                $shopProduct->product_id   = $productId;
                $shopProduct->price        = $validatedData['price'] ?? 0;
                $shopProduct->sale_price   = $validatedData['sale_price'] ?? null;
                $shopProduct->stock        = $validatedData['stock'] ?? 0;
                $shopProduct->min_order    = $validatedData['min_order'] ?? 1;
                $shopProduct->max_order    = $validatedData['max_order'] ?? null;
                $shopProduct->is_available = $validatedData['is_available'] ?? true;
                $shopProduct->sale_start   = $validatedData['sale_start'] ?? null;
                $shopProduct->sale_end     = $validatedData['sale_end'] ?? null;
                $shopProduct->local_image  = $uploadedLocalImage;
                $shopProduct->save();

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Catalog product successfully added to your storefront.',
                    'data'    => $shopProduct->load('product')
                ], 201);
            }
            // CASE 3: NORMAL ADMIN/SHOP CREATING A NEW GLOBAL PRODUCT + LOCAL STOREFRONT LISTING
            else if ($shopId && !$hasProductId) {

                $globalCount = Product::where('shop_id', $shopId)->count();

                if (!$isActive && $globalCount >= 100) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Your account is inactive and has reached the limit of 100 global products. Please contact the platform owner or super admin to activate your account.'
                    ], 403);
                }

                if ($isActive && $globalCount >= 1000) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'You have reached your maximum limit of 1,000 global products. Please contact the platform owner or super admin to request a limit upgrade.'
                    ], 403);
                }

                if ($request->hasFile('catalog_image')) {
                    $uploadedCatalogImage = $request->file('catalog_image')->store('products/catalog', 'public');
                }
                if ($request->hasFile('local_image')) {
                    $uploadedLocalImage = $request->file('local_image')->store('shops/shop_products', 'public');
                }
                
                $shopProduct = DB::transaction(function () use ($validatedData, $shopId, $uploadedCatalogImage, $uploadedLocalImage) {
                    
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

                    $shopProduct = new ShopProduct();
                    $shopProduct->shop_id      = $shopId;
                    $shopProduct->product_id   = $product->id;
                    $shopProduct->price        = $validatedData['price'] ?? 0;
                    $shopProduct->sale_price   = $validatedData['sale_price'] ?? null;
                    $shopProduct->stock        = $validatedData['stock'] ?? 0;
                    $shopProduct->min_order    = $validatedData['min_order'] ?? 1;
                    $shopProduct->max_order    = $validatedData['max_order'] ?? null;
                    $shopProduct->is_available = $validatedData['is_available'] ?? true;
                    $shopProduct->sale_start   = $validatedData['sale_start'] ?? null;
                    $shopProduct->sale_end     = $validatedData['sale_end'] ?? null;
                    $shopProduct->local_image  = $uploadedLocalImage;
                    $shopProduct->save();

                return $shopProduct;
                });

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Product successfully registered and added to storefront.',
                    'data'    => $shopProduct->load('product')
                ], 201);
            }

            // FALLBACK
            $this->purgeFiles($uploadedCatalogImage, $uploadedLocalImage);
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid context or missing required parameters for product creation.'
            ], 400);

        } catch (ValidationException $e) {
            $this->purgeFiles($uploadedCatalogImage, $uploadedLocalImage);
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed.',
                'errors'  => $e->errors()
            ], 422);
        } catch (Exception $e) {
            $this->purgeFiles($uploadedCatalogImage, $uploadedLocalImage);
            return response()->json([
                'status'  => 'error',
                'message' => 'An unexpected server error occurred.'
            ], 500);
        }
    }
    
    public function index(Request $request)
    {
        $shopId = $request->active_shop?->id;
        if (!$shopId) {
            return response()->json(['status' => 'error', 'message' => 'Shop scope missing.'], 400);
        }

        $query = ShopProduct::with(['product.category', 'product.brand'])
            ->where('shop_id', $shopId);

        
        // 1. TEXT SEARCH (Name, Brand, Category, IDs — Price removed from here)
        
        if ($request->filled('q')) {
            $term = trim($request->input('q'));

            $query->where(function ($subQuery) use ($term) {
                if (is_numeric($term)) {
                    $subQuery->orWhere('id', $term)
                            ->orWhere('product_id', $term);
                }

                // String Search on Catalog Product (Name, Category, Brand)
                $subQuery->orWhereHas('product', function ($pQuery) use ($term) {
                    $pQuery->where('name', 'like', "%{$term}%")
                        ->orWhereHas('category', fn($c) => $c->where('name', 'like', "%{$term}%"))
                        ->orWhereHas('brand', fn($b) => $b->where('name', 'like', "%{$term}%"));
                });
            });
        }

        
        // 2. DEDICATED PRICE FILTERS (Exact Price & Price Range)
        
        if ($request->filled('price')) {
            $query->where('price', (float) $request->input('price'));
        }

       
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->input('max_price'));
        }

        
        // 3. QUICK ADMINISTRATIVE STATUS TABS
        
        if ($request->filled('status')) {
            match ($request->input('status')) {
                'out_of_stock' => $query->where('stock', '<=', 0),
                'low_stock'    => $query->whereBetween('stock', [1, 5]),
                'inactive'     => $query->where('is_available', false),
                'active'       => $query->where('is_available', true),
                default        => null,
            };
        }


        
        if ($request->filled('category_id')) {
            $query->whereHas('product', fn($q) => $q->where('category_id', $request->input('category_id')));
        }

        if ($request->filled('brand_id')) {
            $query->whereHas('product', fn($q) => $q->where('brand_id', $request->input('brand_id')));
        }
        
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = strtolower($request->input('sort_order')) === 'asc' ? 'asc' : 'desc';
        
        $allowedSorts = ['price', 'stock', 'created_at', 'updated_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->latest();
        }

        $perPage = min((int) $request->input('per_page', 20), 100);

        return response()->json([
            'status' => 'success',
            'data'   => $query->paginate($perPage)
        ]);
    }

    public function getProduct(Request $request, $id)
    {
        $shopId = $request->active_shop?->id;
        if (!$shopId) {
            return response()->json(['status' => 'error', 'message' => 'Shop scope missing.'], 400);
        }

        $shopProduct = ShopProduct::with(['product.category', 'product.brand'])
            ->where('shop_id', $shopId)
            ->Where('product_id', $id)
            ->first();

        if (!$shopProduct) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Product inventory record not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $shopProduct
        ]);
    }

    public function updateShopProduct(Request $request, $id)
    {
        $shopId = $request->active_shop?->id;
        if (!$shopId) {
            return response()->json(['status' => 'error', 'message' => 'Shop scope missing.'], 400);
        }

        $shopProduct = ShopProduct::where('shop_id', $shopId)
            ->where('product_id', $id)
            ->first();

        if (!$shopProduct) {
            return response()->json(['status' => 'error', 'message' => 'Shop inventory record not found.'], 404);
        }

        try {
            $validatedData = $request->validate([
                'price'        => 'sometimes|required|numeric|min:0',
                'sale_price'   => [
                    'nullable', 'numeric', 'min:0',
                    function ($attribute, $value, $fail) use ($request, $shopProduct) {
                        $currentPrice = $request->filled('price') ? $request->input('price') : $shopProduct->price;
                        if (is_numeric($currentPrice) && $value >= $currentPrice) {
                            $fail('The sale price must be less than the regular price.');
                        }
                    }
                ],
                'stock'        => 'sometimes|required|integer|min:0',
                'min_order'    => 'integer|min:1',
                'max_order'    => [
                    'nullable', 'integer',
                    function ($attribute, $value, $fail) use ($request, $shopProduct) {
                        $minOrder = $request->filled('min_order') ? $request->input('min_order') : $shopProduct->min_order;
                        if (is_numeric($minOrder) && $value <= $minOrder) {
                            $fail('The max order must be greater than the minimum order.');
                        }
                    }
                ],
                'local_image'  => 'nullable|string|max:255',
                'is_available' => 'boolean',
                'sale_start'   => 'nullable|date',
                'sale_end'     => 'nullable|date|required_with:sale_start|after:sale_start',
            ]);

            $updatedProduct = DB::transaction(function () use ($validatedData, $shopProduct) {

                if (array_key_exists('stock', $validatedData) && (int) $validatedData['stock'] !== (int) $shopProduct->stock) {
                    $shopProduct->last_stock_update = now();
                }

                $shopProduct->fill($validatedData);
                $shopProduct->save();

                return $shopProduct->load(['product.category', 'product.brand']);
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Shop inventory updated successfully.',
                'data'    => $updatedProduct
            ]);

        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An unexpected server error occurred.'], 500);
        }
    }

    public function updateGlobalProduct(Request $request, $productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Global catalog product not found.'], 404);
        }

        $user = $request->user();
        $activeShopId = $request->active_shop?->id;
        $isSuperAdmin = $user && $user->hasRole('super-admin');

        // Ownership Check: User can update IF they are a Super Admin OR if the product belongs to their current shop & creator
        $isCreatorOwner = $activeShopId 
            && (int) $product->shop_id === (int) $activeShopId 
            && (int) $product->creator_id === (int) $user->id;

        if (!$isSuperAdmin && !$isCreatorOwner) {
            return response()->json([
                'status'  => 'error', 
                'message' => 'Unauthorized. You can only update global products created by your shop.'
            ], 403);
        }

        try {
            $validatedData = $request->validate([
                'category_id'   => 'sometimes|required|exists:categories,id',
                'brand_id'      => 'nullable|exists:brands,id',
                'name'          => 'sometimes|required|string|max:255',
                'sku'           => 'nullable|string|max:100|unique:products,sku,' . $product->id,
                'unit'          => 'nullable|string|max:50',
                'description'   => 'nullable|string',
                'catalog_image' => 'nullable|string|max:255',
                'video_url'     => 'nullable|url|max:255',
                'attributes'    => 'nullable|array',
                'has_variants'  => 'boolean',
                // Only Super-Admins should be able to toggle verification status
                'is_verified'   => $isSuperAdmin ? 'boolean' : 'prohibited', 
            ]);

            // Automatically update slug if name is updated
            if (isset($validatedData['name']) && $validatedData['name'] !== $product->name) {
                $validatedData['slug'] = Str::slug($validatedData['name']) . '-' . $product->id;
            }

            $product->update($validatedData);

            return response()->json([
                'status'  => 'success',
                'message' => 'Global product updated successfully.',
                'data'    => $product->load(['category', 'brand'])
            ]);

        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An unexpected server error occurred.'], 500);
        }
    }

    public function updateProductImage(Request $request, $product_id)
    {
        $shopId = $request->active_shop?->id;
        if (!$shopId) {
            return response()->json(['status' => 'error', 'message' => 'Shop scope missing.'], 400);
        }

        $shopProduct = ShopProduct::where('shop_id', $shopId)
            ->where('product_id', $product_id)
            ->first();

        if (!$shopProduct) {
            return response()->json(['status' => 'error', 'message' => 'Shop product record not found.'], 404);
        }

        try {
            $request->validate([
                'local_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            if ($request->hasFile('local_image')) {
                $oldImage = $shopProduct->local_image;
                
                $path = $request->file('local_image')->store('shops/shop_products', 'public');
                $shopProduct->local_image = $path;
                $shopProduct->save();

                if ($oldImage) {
                    $this->purgeFiles($oldImage);
                }

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Storefront product image asset updated.',
                    'data'    => [
                        'local_image' => $path,
                        'image_url'   => asset('storage/' . $path)
                    ]
                ]);
            }

            return response()->json(['status' => 'error', 'message' => 'No image file was uploaded.'], 400);

        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An unexpected server error occurred during upload.'], 500);
        }
    }

    public function updateCatalogImage(Request $request, $product_id)
    {
        $user = $request->user();
        $activeShopId = $request->active_shop?->id;
        $isSuperAdmin = $user && $user->hasRole('super-admin');

        $product = Product::find($product_id);

        if (!$product) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Global catalog product record not found.'
            ], 404);
        }

        
        $isGlobalSuperAdminAsset = $isSuperAdmin && $product->shop_id === null;
        $isCreatorOwner = $activeShopId 
            && (int) $product->shop_id === (int) $activeShopId 
            && (int) $product->creator_id === (int) $user->id;

        if (!$isGlobalSuperAdminAsset && !$isCreatorOwner) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized. You can only update catalog assets for products created by your entity.'
            ], 403);
        }

        try {
            $request->validate([
                'catalog_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            if ($request->hasFile('catalog_image')) {
                $oldImage = $product->catalog_image;

                $path = $request->file('catalog_image')->store('products/catalog', 'public');

                $product->catalog_image = $path;
                $product->save();

                
                if ($oldImage) {
                    $this->purgeFiles($oldImage);
                }

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Global master catalog image asset updated.',
                    'data'    => [
                        'catalog_image' => $path,
                        'image_url'     => asset('storage/' . $path)
                    ]
                ]);
            }

            return response()->json(['status' => 'error', 'message' => 'No image file was uploaded.'], 400);

        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An unexpected server error occurred during catalog image upload.'
            ], 500);
        }
    }
    
    public function deleteShopProduct(Request $request, $id)
    {
        $shopId = $request->active_shop?->id;
        if (!$shopId) {
            return response()->json(['status' => 'error', 'message' => 'Shop scope missing.'], 400);
        }

        $shopProduct = ShopProduct::where('shop_id', $shopId)
            ->Where('product_id', $id)
            ->first();

        if (!$shopProduct) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Shop inventory record not found.'
            ], 404);
        }

        $productId = $shopProduct->product_id;

        try {
            DB::transaction(function () use ($request, $shopProduct, $shopId, $productId) {
                $shopProduct->delete();

                $usedByOtherShops = ShopProduct::where('product_id', $productId)
                    ->where('shop_id', '!=', $shopId)
                    ->exists();

                if (!$usedByOtherShops) {
                    $globalProduct = Product::find($productId);
                    $user = $request->user();

                    if ($globalProduct) {
                        $isCreator = (int) $globalProduct->creator_id === (int) $user?->id;
                        $isCreatorShop = (int) $globalProduct->shop_id === (int) $shopId;
                        $isSuperAdmin = $user && $user->hasRole('super-admin');

                        // Delete global record if created by this shop/user OR if action performed by Super-Admin
                        if ($isSuperAdmin || ($isCreator && $isCreatorShop)) {
                            $superAdminId = Admin::role('super-amdin')->value('id');
                            $globalProduct->shop_id = null;
                            $globalProduct->creator_id = $superAdminId;
                            $globalProduct->save();
                        }
                    }
                }
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Product successfully removed from your shop inventory and processed for catalog cleanup.'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An unexpected server error occurred while deleting the product.'
            ], 500);
        }
    }
    public function deleteGlobalProduct(Request $request, $product_id)
    {
        $admin = $request->user(); 
        $isSuperAdmin = $admin->hasRole('super-admin');
        $activeShopId = $request->active_shop?->id;

        $product = Product::withTrashed()->find($product_id);

        if (!$product) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Global catalog product not found.'
            ], 404);
        }

        
        $isCreator = $activeShopId 
            && (int) $product->shop_id === (int) $activeShopId 
            && (int) $product->creator_id === (int) $admin->id;

        if (!$isSuperAdmin && !$isCreator) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized. You can only manage global products created by your shop entity.'
            ], 403);
        }

        try {
            $wasTransferred = false;

            DB::transaction(function () use ($product, $product_id, $isSuperAdmin, $activeShopId, &$wasTransferred) {

            
                if ($isSuperAdmin) {
                    $product->delete();
                    ShopProduct::where('product_id', $product_id)->delete();
                    return;
                }

                $usedByOtherShops = ShopProduct::where('product_id', $product_id)
                    ->where('shop_id', '!=', $activeShopId)
                    ->exists();

                if ($usedByOtherShops) {

                    $superAdminId = Admin::role('super-admin')->value('id');

                    $product->forceFill([
                        'shop_id'    => null,
                        'creator_id' => $superAdminId,
                    ])->save();

                    ShopProduct::where('product_id', $product_id)
                        ->where('shop_id', $activeShopId)
                        ->delete();

                    $wasTransferred = true;
                } else {

                    $product->delete();
                    ShopProduct::where('product_id', $product_id)->delete();
                }
            });

            if ($isSuperAdmin) {
                $message = 'Global product and all associated shop listings soft-deleted successfully.';
            } else if ($wasTransferred) {
                $message = 'Product removed from your shop inventory. Catalog ownership transferred to platform because other shops feature this item.';
            } else {
                $message = 'Product removed from your inventory and soft-deleted from global catalog.';
            }

            return response()->json([
                'status'  => 'success',
                'message' => $message
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An unexpected server error occurred.'
            ], 500);
        }
    }

    public function forceDeleteShopProduct(Request $request, $product_id)
    {
        $shopId = $request->active_shop?->id;
        if (!$shopId) {
            return response()->json(['status' => 'error', 'message' => 'Shop scope missing.'], 400);
        }

        $shopProduct = ShopProduct::withTrashed()
            ->where('shop_id', $shopId)
            ->where('product_id', $product_id)
            ->first();

        if (!$shopProduct) {
            return response()->json(['status' => 'error', 'message' => 'Shop inventory record not found.'], 404);
        }
        $hasLocalOrders = OrderItem::where('product_id', $product_id)
            ->whereHas('order', function ($query) use ($shopId) {
                $query->where('shop_id', $shopId);
            })
            ->exists();

        if ($hasLocalOrders) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Cannot permanently delete this product because historical customer orders depend on it.'
            ], 422);
        }

        try {
            DB::transaction(function () use ($shopProduct, $shopId, $product_id) {

                $localImagePath = $shopProduct->local_image;

                
                $shopProduct->forceDelete();

                if ($localImagePath) {
                    $this->purgeFiles($localImagePath);
                }

                $globalProduct = Product::withTrashed()->find($product_id);

                if ($globalProduct && (int) $globalProduct->shop_id === (int) $shopId) {
                    
                    $otherShopsExist = ShopProduct::withTrashed()
                        ->where('product_id', $product_id)
                        ->exists();

                    if ($otherShopsExist) {
                        $superAdminId = Admin::role('super-admin')->value('id');

                        $globalProduct->forceFill([
                            'shop_id'    => null,
                            'creator_id' => $superAdminId,
                        ])->save();
                    } else {
                        
                        if (!$globalProduct->orderItems()->exists()) {
                            $catalogImagePath = $globalProduct->catalog_image;

                            $globalProduct->forceDelete();

                            if ($catalogImagePath) {
                                $this->purgeFiles($catalogImagePath);
                            }
                        }
                    }
                }
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Product permanently removed from your shop inventory and storage files purged.'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An unexpected server error occurred during permanent deletion.'
            ], 500);
        }
    }

    public function forceDeleteGlobalProduct(Request $request, $product_id)
    {
        $admin = $request->user();
        $isSuperAdmin = $admin->hasRole('super-admin');
        $activeShopId = $request->active_shop?->id;

        $globalProduct = Product::withTrashed()->find($product_id);

        if (!$globalProduct) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Global catalog product not found.'
            ], 404);
        }

        $isCreator = $activeShopId 
            && (int) $globalProduct->shop_id === (int) $activeShopId 
            && (int) $globalProduct->creator_id === (int) $admin->id;

        if (!$isSuperAdmin && !$isCreator) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized. You can only manage global products created by your shop.'
            ], 403);
        }

        $otherShopsExist = ShopProduct::withTrashed()
            ->where('product_id', $product_id)
            ->where('shop_id', '!=', $activeShopId)
            ->exists();

        try {
            $wasTransferred = false;

            DB::transaction(function () use (
                $globalProduct, 
                $product_id, 
                $isSuperAdmin, 
                $activeShopId, 
                $otherShopsExist, 
                &$wasTransferred
            ) {
                // SCENARIO 1: Creator tries to delete, but OTHER SHOPS ARE USING IT
                if (!$isSuperAdmin && $otherShopsExist) {

                    $localShopProduct = ShopProduct::withTrashed()
                        ->where('product_id', $product_id)
                        ->where('shop_id', $activeShopId)
                        ->first();

                    // Check if THIS specific creator shop has orders for this product
                    $hasLocalOrders = OrderItem::where('product_id', $product_id)
                        ->whereHas('order', function ($query) use ($activeShopId) {
                            $query->where('shop_id', $activeShopId);
                        })
                        ->exists();

                    if ($hasLocalOrders) {
                        throw new \Exception('LOCAL_ORDER_RESTRICTION');
                    }

                    // Transfer global ownership to Super-Admin
                    $superAdminId = Admin::role('super-admin')->value('id');

                    $globalProduct->forceFill([
                        'shop_id'    => null,
                        'creator_id' => $superAdminId,
                    ])->save();

                    // Delete ONLY creator local inventory & media
                    if ($localShopProduct) {
                        $localImage = $localShopProduct->local_image;

                        $localShopProduct->forceDelete();

                        if ($localImage) {
                            $this->purgeFiles($localImage);
                        }
                    }

                    $wasTransferred = true;
                    return;
                }

                // SCENARIO 2: SUPER-ADMIN OR UNUSED BY OTHERS -> FULL CASCADE
                
                // Check GLOBAL order restriction across entire platform
                $hasGlobalOrders = OrderItem::where('product_id', $product_id)->exists();

                if ($hasGlobalOrders) {
                    throw new \Exception('GLOBAL_ORDER_RESTRICTION');
                }

                $catalogImagePath = $globalProduct->catalog_image;

                $localImagePaths = ShopProduct::withTrashed()
                    ->where('product_id', $product_id)
                    ->whereNotNull('local_image')
                    ->pluck('local_image')
                    ->toArray();

                ShopProduct::withTrashed()
                    ->where('product_id', $product_id)
                    ->forceDelete();

                $globalProduct->forceDelete();

                if ($catalogImagePath) {
                    $this->purgeFiles($catalogImagePath);
                }

                foreach ($localImagePaths as $localPath) {
                    if ($localPath) {
                        $this->purgeFiles($localPath);
                    }
                }
            });

            if ($wasTransferred) {
                $message = 'Product unlinked from your shop and local media purged. Global catalog ownership transferred to Super-Admin.';
            } else {
                $message = 'Global product, associated shop listings, and storage files permanently purged platform-wide.';
            }

            return response()->json([
                'status'  => 'success',
                'message' => $message
            ], 200);

        } catch (\Exception $e) {
            if ($e->getMessage() === 'LOCAL_ORDER_RESTRICTION') {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Cannot permanently remove product from your shop because customer orders depend on your local inventory history.'
                ], 422);
            }

            if ($e->getMessage() === 'GLOBAL_ORDER_RESTRICTION') {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Cannot permanently delete global product because historical customer orders depend on it platform-wide.'
                ], 422);
            }

            return response()->json([
                'status'  => 'error',
                'message' => 'An unexpected server error occurred during permanent deletion.'
            ], 500);
        }
    }
    private function purgeFiles(?string ...$files): void
    {
            foreach ($files as $file) {
                if ($file && Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
    }
    
}
