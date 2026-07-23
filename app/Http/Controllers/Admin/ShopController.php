<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Admin;


class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::where('admin_id', Auth::id())->get();

        return response()->json([
            'status' => 'success',
            'count' => $shops->count(),
            'data' => $shops
        ]);
        
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255|unique:shops,shop_name',
            'description' => 'required|string',
            'business_email' => 'nullable|email|max:255',
            'contact_no' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'theme_color' => 'nullable|string|max:7',
            'opening_hours' => 'nullable|array',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);
         if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('shops/logos', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('shops/covers', 'public');
        }
        $slug = Str::slug($validatedData['shop_name']);
        $originalSlug = $slug;
        $count = 1;
        while (Shop::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $shop = new  Shop();
        $shop->fill($validatedData);
        $shop->admin_id = Auth::id();
        $shop->slug = $slug;
        $shop->status = 'pending';
        $shop->commission_rate = 0.00;
        $shop->balance = 0.00;
        $shop->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Shop application submitted successfully. Awaiting Superadmin Activation.',
            'data' => $shop
        ], 201);

    }
    public function show(Request $request)
    {
        $shop = $request->active_shop;

        return response()->json([
            'status' => 'success',
            'data'   => $shop
        ]);
    }

    public function update(Request $request)
    {
        $shop = $request->active_shop;

        $validatedData = $request->validate([
            'shop_name'        => "sometimes|required|string|max:255|unique:shops,shop_name,{$shop->id}",
            'description'      => 'nullable|string',
            'theme_color'      => 'nullable|string|max:7',
            'business_email'   => 'nullable|email|max:255',
            'contact_no'       => 'nullable|string|max:20',
            'address'          => 'nullable|string',
            'map_location'     => 'nullable|string',
            'latitude'         => 'nullable|numeric|between:-90,90',
            'longitude'        => 'nullable|numeric|between:-180,180',
            'is_open'          => 'boolean',
            'opening_hours'    => 'nullable|array',
            'social_links'     => 'nullable|array',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if (isset($validatedData['shop_name']) && $validatedData['shop_name'] !== $shop->shop_name) {
            $slug = Str::slug($validatedData['shop_name']);
            $originalSlug = $slug;
            $count = 1;
            while (Shop::where('slug', $slug)->where('id', '!=', $shop->id)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }

            $validatedData['slug'] = $slug;
        }
        $shop->update($validatedData);

        return response()->json([
            'status'  => 'success',
            'message' => 'Shop configuration updated successfully.',
            'data'    => $shop
        ]);
    }

    public function updateBranding(Request $request)
    {
        $shop = $request->active_shop;

        $request->validate([
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $updatedFields = [];
        $oldLogo = $shop->logo;
        $oldCover = $shop->cover_image;

        if ($request->hasFile('logo')) {
            $updatedFields['logo'] = $request->file('logo')->store('shops/logos', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $updatedFields['cover_image'] = $request->file('cover_image')->store('shops/covers', 'public');
        }

        if (!empty($updatedFields)) {
            $shop->update($updatedFields);

            if (isset($updatedFields['logo']) && $oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            if (isset($updatedFields['cover_image']) && $oldCover && Storage::disk('public')->exists($oldCover)) {
                Storage::disk('public')->delete($oldCover);
            }

            $shop->refresh();
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Branding assets updated successfully.',
            'data'    => $shop
        ]);
    }

    public function destroy(Request $request)
    {
        $shop = $request->active_shop;

        $shop->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Shop soft-deleted successfully.'
        ], 200);
    }

    public function forceDelete(Request $request)
    {
        $shop = $request->active_shop;

        $hasActiveOrders = Order::where('shop_id', $shop->id)
            ->whereIn('status', ['pending', 'processing', 'shipped'])
            ->exists();

        if ($hasActiveOrders) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Cannot delete shop. Active orders (pending, processing, or shipped) are still in progress.'
            ], 422);
        }

        $superadmin = Admin::where('role', 'superadmin')->first();
        $superadminId = $superadmin ? $superadmin->id : 1;

        $filesToDelete = [];

        DB::transaction(function () use ($shop, $superadminId, &$filesToDelete) {

            $products = $shop->products()->withTrashed()->get();

            foreach ($products as $product) {
                if ($product->pivot->local_image) {
                    $filesToDelete[] = $product->pivot->local_image;
                }

                $otherShopsCount = $product->shops()->where('shop_id', '!=', $shop->id)->count();

                if ($otherShopsCount === 0) {
                    if ($product->catalog_image) {
                        $filesToDelete[] = $product->catalog_image;
                    }
                    $product->forceDelete();
                } else {
                    if ($product->creator_id === $shop->admin_id || $product->shop_id === $shop->id) {
                        $product->creator_id = $superadminId;
                        $product->shop_id    = null;
                        $product->save();
                    }
                }
            }

            if ($shop->logo) {
                $filesToDelete[] = $shop->logo;
            }
            if ($shop->cover_image) {
                $filesToDelete[] = $shop->cover_image;
            }

            $shop->forceDelete();
        });
        foreach (array_unique($filesToDelete) as $filePath) {
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Shop and all associated assets permanently deleted.'
        ], 200);
    }
    //
}
