<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shop;
use App\Models\ShopProduct;
use App\Notifications\AdminNewOrderNotification;
use App\Notifications\OrderPlacedNotification;
use App\Notifications\OrderStatusUpdatedNotification;
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
        // 1. Execute DB Transaction (Creates orders & clears cart)
        $createdOrders = DB::transaction(function () use ($user, $validatedData) {
            $cart = Cart::with(['items.shopProduct.product.category'])
                ->where('user_id', $user->id)
                ->lockForUpdate()
                ->first();

            if (! $cart || $cart->items->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => ['Your cart is empty or no longer available.'],
                ]);
            }

            // Group items by shop_id for multi-vendor splitting
            $groupedItems = $cart->items->groupBy('shop_id');
            $orders = [];

            foreach ($groupedItems as $shopId => $items) {
                $shop = Shop::findOrFail($shopId);

                $subtotal = 0;
                $orderItemsData = [];

                // Verify availability & stock with pessimistic locking per shop product
                foreach ($items as $item) {
                    /** @var ShopProduct|null $shopProduct */
                    $shopProduct = ShopProduct::where('id', $item->shop_product_id)
                        ->where('shop_id', $shopId)
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
                        'product_id'   => $shopProduct->id,
                        'product_name' => $shopProduct->product->name ?? 'Product',
                        'product_sku'  => $shopProduct->product->slug ?? ('SKU-' . $shopProduct->id),
                        'quantity'     => $item->quantity,
                        'unit_price'   => $unitPrice,
                        'total_price'  => $itemTotal,
                        'attributes'   => $item->attributes,
                    ];
                }

                // Calculate commission via product category hierarchy
                $firstProduct = $items->first()->shopProduct->product ?? null;
                $commissionRate = $firstProduct->category->effective_commission ?? 0.00;

                $shippingCost = 0.00;
                $discountAmount = 0.00;
                $totalPrice = $subtotal + $shippingCost - $discountAmount;

                $commissionAmount = ($totalPrice * $commissionRate) / 100;
                $vendorEarning = $totalPrice - $commissionAmount;

                $shippingAddress = is_array($validatedData['shipping_address'])
                    ? json_encode($validatedData['shipping_address'])
                    : $validatedData['shipping_address'];

                $billingAddressRaw = $validatedData['billing_address'] ?? $validatedData['shipping_address'];
                $billingAddress = is_array($billingAddressRaw)
                    ? json_encode($billingAddressRaw)
                    : $billingAddressRaw;

                // Create Order record for this specific vendor
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
                    'payment_status'    => $validatedData['payment_method'] === 'cod' ? 'pending' : 'unpaid',
                    'payment_method'    => $validatedData['payment_method'],
                    'customer_name'     => $validatedData['customer_name'],
                    'customer_phone'    => $validatedData['customer_phone'],
                    'shipping_address'  => $shippingAddress,
                    'billing_address'   => $billingAddress,
                    'customer_note'     => $validatedData['customer_note'] ?? null,
                ]);

                // Insert OrderItems and deduct inventory stock
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

                    /** @var ShopProduct $shopProduct */
                    $shopProduct = $itemData['shop_product'];
                    $newStock = $shopProduct->stock - $itemData['quantity'];

                    $shopProduct->update([
                        'stock'        => max(0, $newStock),
                        'is_available' => $newStock > 0,
                    ]);
                }

                OrderItem::insert($itemsToCreate);

                // Load shop along with its single owner admin using correct 'owner' relation
                $orders[] = $order->load(['orderItems', 'shop.owner']);
            }

            // Clear cart items after successful order creation
            $cart->items()->delete();

            return $orders;
        });

        // 2. Dispatch Notifications AFTER DB transaction commits safely
        foreach ($createdOrders as $order) {
            // A. Send Order Confirmation to Customer
            $user->notify(new OrderPlacedNotification($order));

            // B. Send AdminNewOrderNotification directly to the shop owner (Admin model)
            if ($order->shop && $order->shop->owner) {
                $order->shop->owner->notify(new AdminNewOrderNotification($order));
            }
        }

        return $createdOrders;
    }

    /**
     * Cancel an existing order if unpaid (if order in cod mode) and restore inventory stock.
     */
    public function cancelOrder(Order $order, string $reason): Order
    {
        $cancelledOrder = DB::transaction(function () use ($order, $reason) {
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
                        ->where('id', $item->product_id)
                        ->withShop($order->shop_id)
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

        // Dispatch status change and notify the amdin or shop  owners 
        if ($cancelledOrder->shop && $cancelledOrder->shop->owner) {
            $cancelledOrder->shop->owner->notify(new OrderStatusUpdatedNotification($cancelledOrder));
        }

        return $cancelledOrder;
    }
}