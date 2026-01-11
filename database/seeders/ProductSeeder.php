<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $electronics   = Category::where('slug', 'electronics')->first()?->id;
        $gamingLaptops = Category::where('slug', 'gaming-laptops')->first()?->id;
        $computers     = Category::where('slug', 'computers-laptops')->first()?->id;
        $mensShoes     = Category::where('slug', 'mens-shoes')->first()?->id;
        $fashion       = Category::where('slug', 'fashion')->first()?->id;
        $services      = Category::where('slug', 'digital-services')->first()?->id;

        $samsung = Brand::where('slug', 'samsung')->first()?->id;
        $apple   = Brand::where('slug', 'apple')->first()?->id;
        $nike    = Brand::where('slug', 'nike')->first()?->id;

        // 1. ELECTRONICS - Level 3 (Gaming Laptops)
        Product::create([
            'category_id'   => $gamingLaptops,
            'brand_id'      => $samsung,
            'name'          => 'Samsung Odyssey G9 49"',
            'slug'          => 'samsung-odyssey-g9-49',
            'sku'           => 'ELEC-SAM-001',
            'unit'          => 'piece',
            'description'   => 'Ultra-wide curved gaming monitor.',
            'catalog_image' => 'products/odyssey.jpg',
            'has_variants'  => false,
            'is_verified'   => true, // Verified by Superadmin
        ]);

        // 2. ELECTRONICS - Level 2 (Computers)
        Product::create([
            'category_id'   => $computers,
            'brand_id'      => $apple,
            'name'          => 'MacBook Pro M3',
            'slug'          => 'macbook-pro-m3',
            'sku'           => 'ELEC-APP-002',
            'unit'          => 'piece',
            'description'   => 'The most powerful MacBook yet.',
            'catalog_image' => 'products/macbook.jpg',
            'attributes'    => json_encode(['RAM' => '16GB', 'Storage' => '512GB']),
            'has_variants'  => true,
            'is_verified'   => true,
        ]);

        // 3. FASHION - Level 2 (Men's Shoes)
        Product::create([
            'category_id'   => $mensShoes,
            'brand_id'      => $nike,
            'name'          => 'Nike Air Jordan 1 Low',
            'slug'          => 'nike-air-jordan-1-low',
            'sku'           => 'FASH-NIKE-003',
            'unit'          => 'pair',
            'description'   => 'Classic sneakers for everyday wear.',
            'catalog_image' => 'products/jordan.jpg',
            'attributes'    => json_encode(['Colors' => ['Red', 'Blue'], 'Sizes' => [40, 41, 42]]),
            'has_variants'  => true,
            'is_verified'   => true,
        ]);

        // 4. FASHION - Level 1 (Fashion Parent)
        Product::create([
            'category_id'   => $fashion,
            'brand_id'      => null, // Testing Nullable Brand
            'name'          => 'Generic Cotton T-Shirt',
            'slug'          => 'generic-cotton-tshirt',
            'sku'           => 'FASH-GEN-004',
            'unit'          => 'piece',
            'description'   => '100% pure cotton t-shirt.',
            'is_verified'   => false, // Testing Unverified Status
        ]);

        // 5. SERVICES - Level 1 (Digital Services)
        Product::create([
            'category_id'   => $services,
            'brand_id'      => null,
            'name'          => 'Web Development Consultation',
            'slug'          => 'web-dev-consultation',
            'sku'           => 'SERV-005',
            'unit'          => 'hour',
            'description'   => 'Expert consultation for your web projects.',
            'video_url'     => 'https://youtube.com/watch?v=demo',
            'is_verified'   => true,
        ]);

        // 6-10. Batch create for testing pagination (Mixed)
        for ($i = 6; $i <= 10; $i++) {
            Product::create([
                'category_id' => $electronics,
                'brand_id'    => $apple,
                'name'        => "Apple Accessory $i",
                'slug'        => "apple-accessory-$i",
                'sku'         => "SKU-ACC-00$i",
                'unit'        => 'piece',
                'is_verified' => ($i % 2 == 0), // Half verified, half not
            ]);
        }
    }
}
