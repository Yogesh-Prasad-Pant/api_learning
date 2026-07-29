<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getOrCreateCart(Request $request): Cart
    {
        // 1. Check Sanctum Guard for Bearer Token
        if (auth('sanctum')->check()) {
            return Cart::firstOrCreate(['user_id' => auth('sanctum')->id()]);
        }

        // 2. Fallback to Guest Header (Mandatory for Stateless API Guests)
        $sessionId = $request->header('X-Session-ID') ?? $request->header('X-Guest-Token');

        if (!$sessionId) {
            // Optional: If you use traditional session-based SPA, fallback to request session
            $sessionId = $request->hasSession() ? $request->session()->getId() : null;
        }

        if (!$sessionId) {
            abort(400, 'A valid authorization token or X-Session-ID header is required.');
        }

        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    public function index(Request $request)
    {
        $cart = $this->getOrCreateCart($request);
        $cart->load(['items.shopProduct', 'items.shop']);
        $groupedItems = $cart->items->groupBy('shop_id')->map(function ($items, $shopId) {
            $shop = $items->first()->shop;

            $shopSubtotal = $items->sum(function ($item) {
                
                return $item->quantity * ($item->shopProduct->price ?? 0);
            });

            return [
                'shop_id' => $shopId,
                'shop_name' => $shop->name ?? 'Unknown Shop',
                'subtotal' => round($shopSubtotal, 2),
                'items' => $items,
            ];
        })->values();

        $grandTotal = $groupedItems->sum('subtotal');

        return response()->json([
            'status' => 'success',
            'data' => [
                'cart_id' => $cart->id,
                'grand_total' => round($grandTotal, 2),
                'shops' => $groupedItems,
            ]
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_product_id' => 'required|exists:shop_products,id',
            'quantity'        => 'required|integer|min:1',
            'attributes'      => 'nullable|array',
        ]);

        $shopProduct = ShopProduct::findOrFail($validated['shop_product_id']);
        $cart        = $this->getOrCreateCart($request);

        // Prepare attributes as array or null
        $attributes = $validated['attributes'] ?? null;

        // Find matching item in cart
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('shop_product_id', $shopProduct->id)
            ->when($attributes, function ($query) use ($attributes) {
                return $query->where('attributes', json_encode($attributes));
            }, function ($query) {
                return $query->whereNull('attributes');
            })
            ->first();

        $currentCartQty = $existingItem ? $existingItem->quantity : 0;
        $newTotalQty    = $currentCartQty + $validated['quantity'];

        // 🛑 Stock Check
        if (isset($shopProduct->stock) && $newTotalQty > $shopProduct->stock) {
            return response()->json([
                'status'  => 'error',
                'message' => "Cannot add item. Only {$shopProduct->stock} unit(s) available in stock (you already have {$currentCartQty} in cart).",
            ], 422);
        }    

        if ($existingItem) {
            $existingItem->update(['quantity' => $newTotalQty]);
            $cartItem = $existingItem;
        } else {
            $cartItem = CartItem::create([
                'cart_id'         => $cart->id,
                'shop_id'         => $shopProduct->shop_id,
                'shop_product_id' => $shopProduct->id,
                'quantity'        => $validated['quantity'],
                'attributes'      => $attributes,
            ]);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Item added to cart successfully.',
            'data'    => $cartItem->load('shopProduct'),
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = $this->getOrCreateCart($request);
        $cartItem = CartItem::where('cart_id', $cart->id)->where('id', $id)->firstOrFail();

        if ($validated['quantity'] === 0) {
            $cartItem->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Item removed from cart.',
            ]);
        }
        $shopProduct = $cartItem->shopProduct;
        if (isset($shopProduct->stock) && $validated['quantity'] > $shopProduct->stock) {
            return response()->json([
                'status' => 'error',
                'message' => "Cannot update quantity. Only {$shopProduct->stock} unit(s) available in stock.",
            ], 422);
        }
        $cartItem->update(['quantity' => $validated['quantity']]);

        return response()->json([
            'status' => 'success',
            'message' => 'Cart item quantity updated.',
            'data' => $cartItem,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $cart = $this->getOrCreateCart($request);

        $deleted = CartItem::where('cart_id', $cart->id)
            ->where('id', $id)
            ->delete();

        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Item removed from cart.',
        ]);
    }

    public function clear(Request $request)
    {
        $cart = $this->getOrCreateCart($request);
        $cart->items()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart cleared successfully.',
        ]);
    }
}