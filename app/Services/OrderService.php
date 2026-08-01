<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shop;
use App\Models\ShopProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    /**
     * Handle the checkout flow and split cart items by vendor/shop.
     *
     * @param  \App\Models\User  $user
     * @param  array  $validatedData
     * @return array
     *
     * @throws ValidationException
     */
    public function checkout($user, array $validatedData): array
    {
        return DB::transaction(function () use ($user, $validatedData) {
            // 1. Fetch user's cart with items and lock the cart row to prevent concurrent checkouts
            $cart = Cart::with(['items.shopProduct.product'])
                ->where('user_id', $user->id)
                ->lockForUpdate()
                ->first();

            if (! $cart || $cart->items->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => ['Your cart is empty or no longer available.'],
                ]);
            }

            // 2. Group items by shop_id for multi-vendor splitting
            $groupedItems = $cart->items->groupBy('shop_id');
            $createdOrders = [];

            foreach ($groupedItems as $shopId => $items) {
                $shop = Shop::findOrFail($shopId);

                $subtotal = 0;
                $orderItemsData = [];

                // 3. Verify availability & stock with pessimistic locking per shop product
                foreach ($items as $item) {
                    $shopProduct = ShopProduct::where('id', $item->shop_product_id)
                        ->lockForUpdate()
                        ->first();

                    if (! $shopProduct || ! $shopProduct->is_available || $shopProduct->stock < $item->quantity) {
                        $productName = $item->shopProduct->product->name ?? 'Product';
                        throw ValidationException::withMessages([
                            'stock' => ["Item '{$productName}' is out of stock or unavailable."],
                        ]);
                    }

                    $unitPrice = $shopProduct->effective_price;
                    $itemTotal = $unitPrice * $item->quantity;
                    $subtotal += $itemTotal;

                    $orderItemsData[] = [
                        'shop_product' => $shopProduct,
                        'product_id'   => $shopProduct->product_id,
                        'product_name' => $item->shopProduct->product->name ?? 'Product',
                        'product_sku'  => $item->shopProduct->product->sku ?? null,
                        'quantity'     => $item->quantity,
                        'unit_price'   => $unitPrice,
                        'total_price'  => $itemTotal,
                        'attributes'   => $item->attributes,
                    ];
                }

                // 4. Calculate commission and earnings
                $shippingCost = 0.00;
                $discountAmount = 0.00;
                $totalPrice = $subtotal + $shippingCost - $discountAmount;

                $commissionRate = $shop->commission_rate ?? 0.00;
                $commissionAmount = ($totalPrice * $commissionRate) / 100;
                $vendorEarning = $totalPrice - $commissionAmount;

                // 5. Create Order record for this specific vendor
                $shippingAddress = is_array($validatedData['shipping_address'])
                    ? json_encode($validatedData['shipping_address'])
                    : $validatedData['shipping_address'];

                $billingAddressRaw = $validatedData['billing_address'] ?? $validatedData['shipping_address'];
                $billingAddress = is_array($billingAddressRaw)
                    ? json_encode($billingAddressRaw)
                    : $billingAddressRaw;

                $order = Order::create([
                    'shop_id'           => $shopId,
                    'user_id'           => $user->id,
                    'subtotal'          => $subtotal,
                    'shipping_cost'     => $shippingCost,
                    'discount_amount'   => $discountAmount,
                    'total_price'       => $totalPrice,
                    'commission_rate'   => $commissionRate,
                    'commission_amount' => $commissionAmount,
                    'vendor_earning'    => $vendorEarning,
                    'status'            => 'pending',
                    'payment_status'    => 'pending',
                    'payment_method'    => $validatedData['payment_method'],
                    'customer_name'     => $validatedData['customer_name'],
                    'customer_phone'    => $validatedData['customer_phone'],
                    'shipping_address'  => $shippingAddress,
                    'billing_address'   => $billingAddress,
                    'customer_note'     => $validatedData['customer_note'] ?? null,
                ]);

                // 6. Insert OrderItems and deduct inventory stock
                $itemsToCreate = [];

                foreach ($orderItemsData as $itemData) {
                    $itemsToCreate[] = [
                        'order_id'         => $order->id,
                        'product_id'       => $itemData['product_id'],
                        'product_name'     => $itemData['product_name'],
                        'product_sku'      => $itemData['product_sku'],
                        'quantity'         => $itemData['quantity'],
                        'unit_price'       => $itemData['unit_price'],
                        'total_item_price' => $itemData['total_price'],
                        'attributes'       => is_array($itemData['attributes']) ? json_encode($itemData['attributes']) : $itemData['attributes'],
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ];

                    $shopProduct = $itemData['shop_product'];
                    $newStock = $shopProduct->stock - $itemData['quantity'];

                    $shopProduct->update([
                        'stock'        => max(0, $newStock),
                        'is_available' => $newStock > 0,
                    ]);
                }

                OrderItem::insert($itemsToCreate);

                $createdOrders[] = $order->load('orderItems');
            }

            // 7. Clear cart items after successful order creation
            $cart->items()->delete();

            return $createdOrders;
        });
    }
    public function cancelOrder(Order $order, string $reason): Order
    {
        return DB::transaction(function () use ($order, $reason) {
            $order->update([
                'status'              => 'cancelled',
                'cancel_status'       => 'approved',
                'cancel_reason'       => $reason,
                'cancel_requested_at' => now(),
                'cancelled_at'        => now(),
            ]);

            // Restore stock specifically on the vendor's ShopProduct record
            foreach ($order->orderItems as $item) {
                if ($item->product_id) {
                    $shopProduct = ShopProduct::where('shop_id', $order->shop_id)
                        ->where('product_id', $item->product_id)
                        ->lockForUpdate()
                        ->first();

                    if ($shopProduct) {
                        $newStock = $shopProduct->stock + $item->quantity;
                        $shopProduct->update([
                            'stock'        => $newStock,
                            'is_available' => true,
                        ]);
                    }
                }
            }

            return $order->fresh();
        });
    }
}