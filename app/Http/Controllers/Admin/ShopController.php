<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Str;
use App\Models\Shop;


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
        $shop = new  Shop($validatedData);
        $shop->admin_id = Auth::id();
        $shop->slug = Str::slug($validatedData['shop_name']);

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

        if (isset($validatedData['shop_name'])) {
            $validatedData['slug'] = Str::slug($validatedData['shop_name']);
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

        if ($request->hasFile('logo')) {
            if ($shop->logo && Storage::disk('public')->exists($shop->logo)) {
                Storage::disk('public')->delete($shop->logo);
            }
            $updatedFields['logo'] = $request->file('logo')->store('shops/logos', 'public');
        }

        if ($request->hasFile('cover_image')) {
            if ($shop->cover_image && Storage::disk('public')->exists($shop->cover_image)) {
                Storage::disk('public')->delete($shop->cover_image);
            }
            $updatedFields['cover_image'] = $request->file('cover_image')->store('shops/covers', 'public');
        }

        if (!empty($updatedFields)) {
            $shop->update($updatedFields);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Branding assets updated successfully.',
            'data'    => $shop
        ]);
    }
    //
}
