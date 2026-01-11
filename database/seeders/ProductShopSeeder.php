<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Fetch our related data
        $shop1 = Shop::where('slug', 'johns-tech-world')->first();
        $shop2 = Shop::where('slug', 'johns-fresh-mart')->first();
        $shop3 = Shop::where('slug', 'sarahs-boutique')->first();

        $laptop  = Product::where('slug', 'samsung-odyssey-g9-49')->first();
        $macbook = Product::where('slug', 'macbook-pro-m3')->first();
        $shoes   = Product::where('slug', 'nike-air-jordan-1-low')->first();
        $tshirt  = Product::where('slug', 'generic-cotton-tshirt')->first();
        $service = Product::where('slug', 'web-dev-consultation')->first();

        // SCENARIO 1: Standard Active Product (John's Tech)
        if ($laptop && $shop1) {
            DB::table('product_shop')->insert([
                'product_id'   => $laptop->id,
                'shop_id'      => $shop1->id,
                'price'        => 1500.00,
                'sale_price'   => null,
                'stock'        => 10,
                'min_order'    => 1,
                'max_order'    => 2, // Limit high-value items
                'is_available' => true,
                'created_at'   => now(),
            ]);
        }

        // SCENARIO 2: Flash Sale Item (Sarah's Boutique)
        // Testing sale_start and sale_end logic
        if ($shoes && $shop3) {
            DB::table('product_shop')->insert([
                'product_id'   => $shoes->id,
                'shop_id'      => $shop3->id,
                'price'        => 180.00,
                'sale_price'   => 120.00,
                'stock'        => 50,
                'min_order'    => 1,
                'sale_start'   => Carbon::now()->subDays(1),
                'sale_end'     => Carbon::now()->addDays(7),
                'local_image'  => 'shops/boutique/shoes_promo.jpg',
                'is_available' => true,
                'created_at'   => now(),
            ]);
        }

        // SCENARIO 3: Out of Stock / Unavailable (John's Fresh Mart)
        if ($macbook && $shop2) {
            DB::table('product_shop')->insert([
                'product_id'   => $macbook->id,
                'shop_id'      => $shop2->id,
                'price'        => 2500.00,
                'stock'        => 0, // Testing 0 stock
                'is_available' => false, // Manually disabled
                'last_stock_update' => Carbon::now()->subHours(5),
                'created_at'   => now(),
            ]);
        }

        // SCENARIO 4: Wholesale Logic (John's Tech)
        // High min_order requirement
        if ($tshirt && $shop1) {
            DB::table('product_shop')->insert([
                'product_id'   => $tshirt->id,
                'shop_id'      => $shop1->id,
                'price'        => 25.00,
                'stock'        => 500,
                'min_order'    => 10, // Must buy at least 10
                'max_order'    => 100,
                'is_available' => true,
                'created_at'   => now(),
            ]);
        }

        // SCENARIO 5: Digital Service (Sarah's Boutique)
        if ($service && $shop3) {
            DB::table('product_shop')->insert([
                'product_id'   => $service->id,
                'shop_id'      => $shop3->id,
                'price'        => 100.00,
                'stock'        => 9999, // Infinite service
                'is_available' => true,
                'created_at'   => now(),
            ]);
        }
    }
}
