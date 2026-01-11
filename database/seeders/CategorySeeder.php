<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ============================================================
        // HIERARCHY 1: 3 LEVELS DEEP (Electronics -> Computers -> Gaming)
        // ============================================================
        
        // LEVEL 1
        $electronics = Category::create([
            'name'             => 'Electronics',
            'slug'             => 'electronics',
            'image'            => 'categories/electronics.jpg',
            'banner'           => 'categories/banners/electronics_banner.jpg',
            'icon'             => 'fa-tv',
            'is_menu'          => true,
            'is_active'        => true,
            'is_featured'      => true,
            'parent_id'        => null,
            'depth'            => 0,
            'order_priority'   => 1,
            'commission_rate'  => 10.00,
            'meta_title'       => 'Best Electronics Online',
            'meta_description' => 'Browse latest electronics and gadgets.',
            'meta_keywords'    => 'tech, electronics, gadgets',
            'attributes'       => json_encode(['brand', 'warranty', 'voltage']),
        ]);

        // LEVEL 2
        $computers = Category::create([
            'name'             => 'Computers & Laptops',
            'slug'             => 'computers-laptops',
            'image'            => 'categories/computers.jpg',
            'banner'           => null,
            'icon'             => 'fa-laptop',
            'is_menu'          => true,
            'is_active'        => true,
            'is_featured'      => false,
            'parent_id'        => $electronics->id,
            'depth'            => 1,
            'order_priority'   => 1,
            'commission_rate'  => 8.00,
            'meta_title'       => 'Laptops and PC Components',
            'meta_description' => 'Find the best laptops here.',
            'meta_keywords'    => 'laptop, pc, computer',
            'attributes'       => json_encode(['ram', 'storage', 'processor']),
        ]);

        // LEVEL 3
        Category::create([
            'name'             => 'Gaming Laptops',
            'slug'             => 'gaming-laptops',
            'image'            => 'categories/gaming_laptops.jpg',
            'banner'           => null,
            'icon'             => 'fa-gamepad',
            'is_menu'          => false,
            'is_active'        => true,
            'is_featured'      => true,
            'parent_id'        => $computers->id,
            'depth'            => 2,
            'order_priority'   => 1,
            'commission_rate'  => 12.00,
            'meta_title'       => 'High-End Gaming Laptops',
            'meta_description' => 'NVIDIA Powered Gaming Laptops.',
            'meta_keywords'    => 'gaming, rtx, laptop',
            'attributes'       => json_encode(['gpu', 'refresh_rate']),
        ]);

        // ============================================================
        // HIERARCHY 2: 2 LEVELS DEEP (Fashion -> Men's Shoes)
        // ============================================================
        
        $fashion = Category::create([
            'name'             => 'Fashion',
            'slug'             => 'fashion',
            'image'            => 'categories/fashion.jpg',
            'banner'           => 'categories/banners/fashion_banner.jpg',
            'icon'             => 'fa-tshirt',
            'is_menu'          => true,
            'is_active'        => true,
            'is_featured'      => true,
            'parent_id'        => null,
            'depth'            => 0,
            'order_priority'   => 2,
            'commission_rate'  => 15.00,
            'meta_title'       => 'Latest Fashion Trends',
            'meta_description' => 'Shop the best clothing online.',
            'meta_keywords'    => 'clothes, fashion, style',
            'attributes'       => json_encode(['size', 'color', 'material']),
        ]);

        Category::create([
            'name'             => 'Mens Shoes',
            'slug'             => 'mens-shoes',
            'image'            => 'categories/shoes.jpg',
            'banner'           => null,
            'icon'             => 'fa-shoe-prints',
            'is_menu'          => true,
            'is_active'        => true,
            'is_featured'      => false,
            'parent_id'        => $fashion->id,
            'depth'            => 1,
            'order_priority'   => 1,
            'commission_rate'  => 12.00,
            'meta_title'       => 'Branded Shoes for Men',
            'meta_description' => 'Casual and Formal Shoes.',
            'meta_keywords'    => 'shoes, sneakers, boots',
            'attributes'       => json_encode(['shoe_size', 'brand']),
        ]);

        // ============================================================
        // HIERARCHY 3: LEVEL 0 ONLY (Stand-alone)
        // ============================================================
        
        Category::create([
            'name'             => 'Digital Services',
            'slug'             => 'digital-services',
            'image'            => null,
            'banner'           => null,
            'icon'             => 'fa-concierge-bell',
            'is_menu'          => true,
            'is_active'        => true,
            'is_featured'      => false,
            'parent_id'        => null,
            'depth'            => 0,
            'order_priority'   => 3,
            'commission_rate'  => 20.00,
            'meta_title'       => 'Professional Digital Services',
            'meta_description' => 'Web development and design.',
            'meta_keywords'    => 'seo, web, design',
            'attributes'       => null,
        ]);
        //
    }
}
