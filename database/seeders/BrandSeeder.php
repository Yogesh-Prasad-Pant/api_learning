<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Brand 1: Samsung
        Brand::updateOrCreate(
            ['slug' => 'samsung'],
            [
                'name'             => 'Samsung',
                'logo'             => 'brands/logos/samsung.png',
                'banner'           => 'brands/banners/samsung_banner.jpg',
                'is_active'        => true,
                'is_featured'      => true,
                'order_priority'   => 1,
                'website_url'      => 'https://www.samsung.com',
                'meta_title'       => 'Samsung Official Store | Gadgets & Displays',
                'meta_description' => 'Innovative Samsung monitors, smartphones, and consumer electronics.',
                'meta_keywords'    => 'samsung, mobile, odyssey, tv, display',
            ]
        );

        // Brand 2: Apple
        Brand::updateOrCreate(
            ['slug' => 'apple'],
            [
                'name'             => 'Apple',
                'logo'             => 'brands/logos/apple.png',
                'banner'           => 'brands/banners/apple_banner.jpg',
                'is_active'        => true,
                'is_featured'      => true,
                'order_priority'   => 2,
                'website_url'      => 'https://www.apple.com',
                'meta_title'       => 'Apple Store | MacBooks, iPhones & iPads',
                'meta_description' => 'Explore the world of Apple hardware, MacBooks, and accessories.',
                'meta_keywords'    => 'apple, macbook, iphone, ipad, mac',
            ]
        );

        // Brand 3: Nike
        Brand::updateOrCreate(
            ['slug' => 'nike'],
            [
                'name'             => 'Nike',
                'logo'             => 'brands/logos/nike.png',
                'banner'           => 'brands/banners/nike_banner.jpg',
                'is_active'        => true,
                'is_featured'      => true,
                'order_priority'   => 3,
                'website_url'      => 'https://www.nike.com',
                'meta_title'       => 'Nike Performance Apparel & Footwear',
                'meta_description' => 'Iconic Jordan sneakers, running shoes, and sportswear.',
                'meta_keywords'    => 'nike, air jordan, sneakers, sports, running',
            ]
        );

        // Brand 4: Local Craft
        Brand::updateOrCreate(
            ['slug' => 'local-craft'],
            [
                'name'             => 'Local Craft',
                'logo'             => 'brands/logos/local_craft.png',
                'banner'           => null,
                'is_active'        => true,
                'is_featured'      => false,
                'order_priority'   => 4,
                'website_url'      => null,
                'meta_title'       => 'Local Craft Nepal | Handmade Products',
                'meta_description' => 'Locally sourced artisan goods and organic garments.',
                'meta_keywords'    => 'craft, nepalese, local, handmade, organic',
            ]
        );
    }
}