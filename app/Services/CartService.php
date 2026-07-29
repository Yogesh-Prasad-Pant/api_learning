<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;

class CartService
{
    public function mergeGuestCartToUser(string $sessionId, int $userId): void
    {
        $guestCart = Cart::where('session_id', $sessionId)->first();

        if (!$guestCart || $guestCart->items->isEmpty()) {
            return; // Nothing to merge
        }

        // 2. Get or create the user's permanent cart
        $userCart = Cart::firstOrCreate(['user_id' => $userId]);

        foreach ($guestCart->items as $guestItem) {
            $existingUserItem = CartItem::where('cart_id', $userCart->id)
                ->where('shop_product_id', $guestItem->shop_product_id)
                ->when($guestItem->attributes, function ($query) use ($guestItem) {
                    return $query->where('attributes', json_encode($guestItem->attributes));
                }, function ($query) {
                    return $query->whereNull('attributes');
                })
                ->first();

            if ($existingUserItem) {
                $existingUserItem->increment('quantity', $guestItem->quantity);
            } else {
                $guestItem->update(['cart_id' => $userCart->id]);
            }
        }

 
        $guestCart->delete();
    }
}