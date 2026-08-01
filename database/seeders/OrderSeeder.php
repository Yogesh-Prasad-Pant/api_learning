<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShopProduct;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'customer@example.com')->first() ?? User::first();
        $shop = Shop::where('slug', 'sarahs-boutique')->first() ?? Shop::first();

        if ($user && $shop) {
            // Eager load the base product to capture its name/sku snapshot
            $inventory = ShopProduct::with('product')
                ->where('shop_id', $shop->id)
                ->where('is_available', true)
                ->first();

            if ($inventory) {
                $unitPrice    = $inventory->sale_price ?? $inventory->price;
                $quantity     = 2;
                $subtotal     = $unitPrice * $quantity;
                $shippingCost = 150.00;
                $totalPrice   = $subtotal + $shippingCost;

                // Create Order (Matches orders migration schema strictly)
                $order = Order::create([
                    'order_number'     => 'ORD-' . strtoupper(Str::random(10)),
                    'shop_id'          => $shop->id,
                    'user_id'          => $user->id,
                    
                    // Required Customer Snapshot Fields
                    'customer_name'    => $user->name ?? 'John Doe',
                    'customer_phone'   => $user->phone ?? '+977-9800000000',

                    // Required Address Fields (Must be array/JSON)
                    'shipping_address' => [
                        'full_name'      => $user->name ?? 'John Doe',
                        'phone'          => $user->phone ?? '+977-9800000000',
                        'address_line_1' => '123 Main Street',
                        'city'           => 'Kathmandu',
                        'state'          => 'Bagmati',
                        'postal_code'    => '44600',
                        'country'        => 'Nepal',
                    ],
                    'billing_address'  => [
                        'full_name'      => $user->name ?? 'John Doe',
                        'phone'          => $user->phone ?? '+977-9800000000',
                        'address_line_1' => '123 Main Street',
                        'city'           => 'Kathmandu',
                        'state'          => 'Bagmati',
                        'postal_code'    => '44600',
                        'country'        => 'Nepal',
                    ],

                    // Financial Calculations
                    'subtotal'         => $subtotal,
                    'shipping_cost'    => $shippingCost,
                    'discount_amount'  => 0.00,
                    'total_price'      => $totalPrice,
                    'commission_rate'  => $shop->commission_rate ?? 0.00,
                    'commission_amount'=> 0.00,
                    'vendor_earning'   => $subtotal,

                    // Status Enums
                    'status'           => 'pending',
                    'payment_status'   => 'unpaid',
                    'payment_method'   => 'cod',
                    'delivery_type'    => 'shop_self',
                ]);

                // Create Order Item (Matches order_items migration schema)
                OrderItem::create([
                    'order_id'         => $order->id,
                    'product_id'       => $inventory->product_id,
                    
                    // Required Product Snapshots
                    'product_name'     => $inventory->product->name ?? 'Sample Product',
                    'product_sku'      => $inventory->product->sku ?? null,

                    // Financials & Quantities
                    'quantity'         => $quantity,
                    'unit_price'       => $unitPrice,
                    'total_item_price' => $subtotal,
                    'attributes'       => [
                        'size'  => '42',
                        'color' => 'Bred Toe',
                    ],
                ]);
            }
        }
    }
}