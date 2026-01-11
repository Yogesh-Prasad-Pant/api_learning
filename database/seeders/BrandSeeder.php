<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Brand 1: Samsung
        Brand::create([
            'name'             => 'Samsung',
            'slug'             => 'samsung',
            'logo'             => 'brands/logos/samsung.png',
            'banner'           => 'brands/banners/samsung_banner.jpg',
            'is_active'        => true,
            'is_featured'      => true,
            'order_priority'   => 1,
            'website_url'      => 'https://www.samsung.com',
            'meta_title'       => 'Samsung Official Store',
            'meta_description' => 'Latest Samsung smartphones and gadgets.',
            'meta_keywords'    => 'samsung, mobile, electronics',
        ]);

        // Brand 2: Nike
        Brand::create([
            'name'             => 'Nike',
            'slug'             => 'nike',
            'logo'             => 'brands/logos/nike.png',
            'banner'           => 'brands/banners/nike_banner.jpg',
            'is_active'        => true,
            'is_featured'      => true,
            'order_priority'   => 2,
            'website_url'      => 'https://www.nike.com',
            'meta_title'       => 'Nike Sportswear',
            'meta_description' => 'Premium sports shoes and apparel.',
            'meta_keywords'    => 'nike, shoes, fashion',
        ]);

        // Brand 3: Apple
        Brand::create([
            'name'             => 'Apple',
            'slug'             => 'apple',
            'logo'             => 'brands/logos/apple.png',
            'banner'           => null,
            'is_active'        => true,
            'is_featured'      => true,
            'order_priority'   => 3,
            'website_url'      => 'https://www.apple.com',
            'meta_title'       => 'Apple Innovations',
            'meta_description' => 'iPhone, Mac and iPad official products.',
            'meta_keywords'    => 'apple, iphone, macbook',
        ]);

        // Brand 4: Local Craft (Asymmetrical test case)
        Brand::create([
            'name'             => 'Local Craft',
            'slug'             => 'local-craft',
            'logo'             => null,
            'banner'           => null,
            'is_active'        => true,
            'is_featured'      => false,
            'order_priority'   => 4,
            'website_url'      => null,
            'meta_title'       => 'Handmade Local Products',
            'meta_description' => 'Buy locally sourced handmade goods.',
            'meta_keywords'    => 'local, handmade, nepal',
        ]);
        
    }
}
