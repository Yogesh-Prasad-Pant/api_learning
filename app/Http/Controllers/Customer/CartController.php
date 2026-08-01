<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $cart = $this->cartService->getOrCreateCart($request);
        $cart->load(['items.shopProduct', 'items.shop']);

        $groupedItems = $cart->items->groupBy('shop_id')->map(function ($items, $shopId) {
            $shop = $items->first()->shop;

            $shopSubtotal = $items->sum(function ($item) {
                // Resolves sale price or regular price safely
                $unitPrice = $item->shopProduct->sale_price 
                    ?? $item->shopProduct->price 
                    ?? 0;

                return $item->quantity * $unitPrice;
            });

            return [
                'shop_id'   => $shopId,
                'shop_name' => $shop->name ?? 'Unknown Shop',
                'subtotal'  => round($shopSubtotal, 2),
                'items'     => $items,
            ];
        })->values();

        return response()->json([
            'success' => true,
            'message' => 'Cart fetched successfully.',
            'data'    => [
                'cart_id'     => $cart->id,
                'grand_total' => round($groupedItems->sum('subtotal'), 2),
                'shops'       => $groupedItems,
            ]
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'shop_product_id' => 'required|exists:shop_products,id',
            'quantity'        => 'required|integer|min:1',
            'attributes'      => 'nullable|array',
        ]);

        $cart = $this->cartService->getOrCreateCart($request);

        $cartItem = $this->cartService->addItem(
            $cart,
            $validated['shop_product_id'],
            $validated['quantity'],
            $validated['attributes'] ?? null
        );

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully.',
            'data'    => $cartItem,
        ], 201);
    }

    public function count(Request $request): JsonResponse
    {
        $cart = $this->cartService->getOrCreateCart($request);
        $totalItems = $cart->items()->sum('quantity');

        return response()->json([
            'success' => true,
            'data'    => [
                'item_count' => (int) $totalItems,
            ],
        ]);
    }

    public function sync(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items'                   => 'required|array|min:1',
            'items.*.shop_product_id' => 'required|exists:shop_products,id',
            'items.*.quantity'        => 'required|integer|min:1',
            'items.*.attributes'      => 'nullable|array',
        ]);

        $this->cartService->syncGuestCart(
            $request->user()->id,
            $validated['items']
        );

        return response()->json([
            'success' => true,
            'message' => 'Guest cart synchronized successfully with user account.',
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'quantity'   => 'required|integer|min:1',
            'attributes' => 'nullable|array',
        ]);

        $cart = $this->cartService->getOrCreateCart($request);
        $cartItem = $this->cartService->updateItem(
            $cart,
            $id,
            $validated['quantity'],
            $validated['attributes'] ?? null
        );

        return response()->json([
            'success' => true,
            'message' => 'Cart item updated successfully.',
            'data'    => $cartItem,
        ]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $cart = $this->cartService->getOrCreateCart($request);
        $deleted = $this->cartService->removeItem($cart, $id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully.',
        ]);
    }

    public function clear(Request $request): JsonResponse
    {
        $cart = $this->cartService->getOrCreateCart($request);
        $this->cartService->clearCart($cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully.',
        ]);
    }
}