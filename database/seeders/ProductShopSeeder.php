<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shop1 = Shop::where('slug', 'johns-tech-world')->first();
        $shop2 = Shop::where('slug', 'johns-fresh-mart')->first();
        $shop3 = Shop::where('slug', 'sarahs-boutique')->first();

        $laptop  = Product::where('slug', 'samsung-odyssey-g9-49')->first();
        $macbook = Product::where('slug', 'macbook-pro-m3')->first();
        $shoes   = Product::where('slug', 'nike-air-jordan-1-low')->first();
        $tshirt  = Product::where('slug', 'generic-cotton-tshirt')->first();
        $service = Product::where('slug', 'web-dev-consultation')->first();

        // Helper function to maintain unique compound keys (product_id + shop_id)
        $upsertInventory = function ($productId, $shopId, array $data) {
            $exists = DB::table('shop_products')
                ->where('product_id', $productId)
                ->where('shop_id', $shopId)
                ->exists();

            if ($exists) {
                DB::table('shop_products')
                    ->where('product_id', $productId)
                    ->where('shop_id', $shopId)
                    ->update(array_merge($data, ['updated_at' => now()]));
            } else {
                DB::table('shop_products')->insert(array_merge($data, [
                    'product_id' => $productId,
                    'shop_id'    => $shopId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        };

        // Scenario 1: Standard Active Product
        if ($laptop && $shop1) {
            $upsertInventory($laptop->id, $shop1->id, [
                'price'        => 185000.00,
                'sale_price'   => null,
                'stock'        => 8,
                'min_order'    => 1,
                'max_order'    => 2,
                'is_available' => true,
            ]);
        }

        // Scenario 2: Active Flash Sale
        if ($shoes && $shop3) {
            $upsertInventory($shoes->id, $shop3->id, [
                'price'        => 22000.00,
                'sale_price'   => 17500.00,
                'stock'        => 25,
                'min_order'    => 1,
                'max_order'    => 5,
                'sale_start'   => Carbon::now()->subDays(2),
                'sale_end'     => Carbon::now()->addDays(5),
                'local_image'  => 'shops/boutique/jordan_promo.jpg',
                'is_available' => true,
            ]);
        }

        // Scenario 3: Out of Stock
        if ($macbook && $shop1) {
            $upsertInventory($macbook->id, $shop1->id, [
                'price'             => 420000.00,
                'sale_price'        => null,
                'stock'             => 0,
                'min_order'         => 1,
                'max_order'         => 1,
                'is_available'      => false,
                'last_stock_update' => Carbon::now()->subHours(12),
            ]);
        }

        // Scenario 4: Wholesale / Bulk Purchasing
        if ($tshirt && $shop3) {
            $upsertInventory($tshirt->id, $shop3->id, [
                'price'        => 1500.00,
                'sale_price'   => 1200.00,
                'stock'        => 250,
                'min_order'    => 5,
                'max_order'    => 50,
                'is_available' => true,
            ]);
        }

        // Scenario 5: Service Slot Availability
        if ($service && $shop3) {
            $upsertInventory($service->id, $shop3->id, [
                'price'        => 5000.00,
                'stock'        => 999,
                'min_order'    => 1,
                'max_order'    => 10,
                'is_available' => true,
            ]);
        }
    }
}