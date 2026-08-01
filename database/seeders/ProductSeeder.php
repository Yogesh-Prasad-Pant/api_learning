<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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

        // 1. Gaming Monitor
        Product::updateOrCreate(
            ['slug' => 'samsung-odyssey-g9-49'],
            [
                'category_id'   => $gamingLaptops,
                'brand_id'      => $samsung,
                'name'          => 'Samsung Odyssey G9 49" Curved Gaming Monitor',
                'sku'           => 'ELEC-SAM-001',
                'unit'          => 'piece',
                'description'   => '49-inch Dual QHD curved gaming monitor with 240Hz refresh rate and 1ms response time.',
                'catalog_image' => 'products/samsung_odyssey_g9.jpg',
                'attributes'    => json_encode([
                    'Screen Size'  => '49 inch',
                    'Resolution'   => '5120 x 1440',
                    'Refresh Rate' => '240Hz',
                    'Curvature'    => '1000R',
                ]),
                'has_variants'  => false,
                'is_verified'   => true,
            ]
        );

        // 2. High-End Laptop
        Product::updateOrCreate(
            ['slug' => 'macbook-pro-m3'],
            [
                'category_id'   => $computers,
                'brand_id'      => $apple,
                'name'          => 'MacBook Pro 16" M3 Max',
                'sku'           => 'ELEC-APP-002',
                'unit'          => 'piece',
                'description'   => 'The 16-inch MacBook Pro featuring the ultra-powerful M3 Max chip for studio-grade performance.',
                'catalog_image' => 'products/macbook_pro_m3.jpg',
                'attributes'    => json_encode([
                    'RAM'     => '36GB Unified',
                    'Storage' => '1TB SSD',
                    'Color'   => 'Space Black',
                ]),
                'has_variants'  => true,
                'is_verified'   => true,
            ]
        );

        // 3. Footwear
        Product::updateOrCreate(
            ['slug' => 'nike-air-jordan-1-low'],
            [
                'category_id'   => $mensShoes,
                'brand_id'      => $nike,
                'name'          => 'Nike Air Jordan 1 Low OG',
                'sku'           => 'FASH-NIKE-003',
                'unit'          => 'pair',
                'description'   => 'Inspired by the 1985 original, the Air Jordan 1 Low delivers a clean, classic look in low-top form.',
                'catalog_image' => 'products/nike_jordan_1.jpg',
                'attributes'    => json_encode([
                    'Colors' => ['Bred Toe', 'Chicago Red', 'Shadow Grey'],
                    'Sizes'  => [40, 41, 42, 43, 44],
                ]),
                'has_variants'  => true,
                'is_verified'   => true,
            ]
        );

        // 4. Apparel (No Brand - Unverified Test Case)
        Product::updateOrCreate(
            ['slug' => 'generic-cotton-tshirt'],
            [
                'category_id'   => $fashion,
                'brand_id'      => null,
                'name'          => 'Heavyweight Organic Cotton T-Shirt',
                'sku'           => 'FASH-GEN-004',
                'unit'          => 'piece',
                'description'   => '100% combed organic cotton breathable crewneck tee designed for casual everyday wear.',
                'catalog_image' => 'products/cotton_tshirt.jpg',
                'attributes'    => json_encode([
                    'Sizes'  => ['S', 'M', 'L', 'XL'],
                    'Colors' => ['Black', 'White', 'Navy'],
                ]),
                'has_variants'  => true,
                'is_verified'   => false,
            ]
        );

        // 5. Digital Service
        Product::updateOrCreate(
            ['slug' => 'web-dev-consultation'],
            [
                'category_id'   => $services,
                'brand_id'      => null,
                'name'          => 'Full Stack Web Architecture Consultation',
                'sku'           => 'SERV-005',
                'unit'          => 'hour',
                'description'   => '1-on-1 technical architectural review for high-scale web platforms, database optimization, and API security.',
                'catalog_image' => 'products/web_consultation.jpg',
                'attributes'    => json_encode([
                    'Format'   => 'Online Video Call',
                    'Deliverable' => 'PDF Technical Audit Report',
                ]),
                'has_variants'  => false,
                'is_verified'   => true,
            ]
        );

        // 6-10. Accessories batch
        for ($i = 6; $i <= 10; $i++) {
            Product::updateOrCreate(
                ['slug' => "apple-accessory-$i"],
                [
                    'category_id'   => $electronics,
                    'brand_id'      => $apple,
                    'name'          => "Apple MagSafe Adapter Series $i",
                    'sku'           => "SKU-ACC-00$i",
                    'unit'          => 'piece',
                    'description'   => "High-speed fast charging power adapter designed for Mac and iPad accessories (Model $i).",
                    'catalog_image' => "products/magsafe_$i.jpg",
                    'attributes'    => json_encode(['Wattage' => '140W USB-C']),
                    'has_variants'  => false,
                    'is_verified'   => ($i % 2 == 0),
                ]
            );
        }
    }
}