<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartService
{
    /**
     * Retrieve or instantiate a cart for authenticated users or guests.
     */
    public function getOrCreateCart(Request $request): Cart
    {
        if (auth('sanctum')->check()) {
            return Cart::firstOrCreate(['user_id' => auth('sanctum')->id()]);
        }

        $sessionId = $request->header('X-Session-ID')
            ?? $request->header('X-Guest-Token')
            ?? ($request->hasSession() ? $request->session()->getId() : null);

        if (!$sessionId) {
            throw ValidationException::withMessages([
                'session' => ['A valid user authentication token or X-Session-ID header is required.']
            ]);
        }

        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    /**
     * Normalize attribute arrays to guarantee consistent sorting.
     */
    public function normalizeAttributes(?array $attributes): ?array
    {
        if (empty($attributes)) {
            return null;
        }

        ksort($attributes);
        return $attributes;
    }

    /**
     * Add or update an item within the active cart.
     */
    public function addItem(Cart $cart, int $shopProductId, int $quantity, ?array $attributes = null): CartItem
    {
        $shopProduct = ShopProduct::findOrFail($shopProductId);
        $normalizedAttributes = $this->normalizeAttributes($attributes);

        // Check stock & existing item
        $query = CartItem::where('cart_id', $cart->id)
            ->where('shop_product_id', $shopProduct->id);

        if ($normalizedAttributes) {
            // Native Laravel JSON query (Database independent)
            $query->where('attributes', $normalizedAttributes);
        } else {
            $query->whereNull('attributes');
        }

        $existingItem = $query->first();

        $currentQty = $existingItem ? $existingItem->quantity : 0;
        $totalQty = $currentQty + $quantity;

        if (isset($shopProduct->stock) && $totalQty > $shopProduct->stock) {
            throw ValidationException::withMessages([
                'quantity' => ["Only {$shopProduct->stock} unit(s) available in stock."]
            ]);
        }

        if ($existingItem) {
            $existingItem->update(['quantity' => $totalQty]);
            return $existingItem->fresh('shopProduct');
        }

        return CartItem::create([
            'cart_id'         => $cart->id,
            'shop_id'         => $shopProduct->shop_id,
            'shop_product_id' => $shopProduct->id,
            'quantity'        => $quantity,
            'attributes'      => $normalizedAttributes,
        ])->load('shopProduct');
    }

    /**
     * Synchronize offline guest cart items into an authenticated user's cart upon login.
     */
    public function syncGuestCart(int $userId, array $items): void
    {
        $userCart = Cart::firstOrCreate(['user_id' => $userId]);

        foreach ($items as $item) {
            $this->addItem(
                $userCart,
                $item['shop_product_id'],
                $item['quantity'],
                $item['attributes'] ?? null
            );
        }
    }

    /**
     * Update quantity or attributes of an existing cart item.
     */
    public function updateItem(Cart $cart, int $itemId, int $quantity, ?array $attributes = null): CartItem
    {
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('id', $itemId)
            ->firstOrFail();

        $shopProduct = $cartItem->shopProduct;

        if (isset($shopProduct->stock) && $quantity > $shopProduct->stock) {
            throw ValidationException::withMessages([
                'quantity' => ["Only {$shopProduct->stock} unit(s) available in stock."]
            ]);
        }

        $payload = ['quantity' => $quantity];
        if ($attributes !== null) {
            $payload['attributes'] = $this->normalizeAttributes($attributes);
        }

        $cartItem->update($payload);

        return $cartItem->fresh('shopProduct');
    }

    /**
     * Remove a single item from the cart.
     */
    public function removeItem(Cart $cart, int $itemId): bool
    {
        return (bool) CartItem::where('cart_id', $cart->id)
            ->where('id', $itemId)
            ->delete();
    }

    /**
     * Clear all items from the active cart.
     */
    public function clearCart(Cart $cart): void
    {
        $cart->items()->delete();
    }
}