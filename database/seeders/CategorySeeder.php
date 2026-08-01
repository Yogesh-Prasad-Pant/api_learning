<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ============================================================
        // HIERARCHY 1: Electronics (3 Levels)
        // ============================================================
        $electronics = Category::updateOrCreate(
            ['slug' => 'electronics'],
            [
                'name'             => 'Electronics',
                'image'            => 'categories/electronics.jpg',
                'banner'           => 'categories/banners/electronics_banner.jpg',
                'icon'             => 'fa-laptop',
                'is_menu'          => true,
                'is_active'        => true,
                'is_featured'      => true,
                'parent_id'        => null,
                'depth'            => 0,
                'order_priority'   => 1,
                'commission_rate'  => 10.00,
                'meta_title'       => 'Buy Electronics Online | Laptops, Monitors & Tech',
                'meta_description' => 'Explore tech products from leading global brands with warranty.',
                'meta_keywords'    => 'tech, electronics, monitors, laptops, gadgets',
                'attributes'       => json_encode(['Brand', 'Warranty Period', 'Power Consumption']),
            ]
        );

        $computers = Category::updateOrCreate(
            ['slug' => 'computers-laptops'],
            [
                'name'             => 'Computers & Laptops',
                'image'            => 'categories/computers.jpg',
                'banner'           => 'categories/banners/computers_banner.jpg',
                'icon'             => 'fa-desktop',
                'is_menu'          => true,
                'is_active'        => true,
                'is_featured'      => true,
                'parent_id'        => $electronics->id,
                'depth'            => 1,
                'order_priority'   => 1,
                'commission_rate'  => 8.00,
                'meta_title'       => 'Computers & Laptops | Professional Workstations',
                'meta_description' => 'Find ultrabooks, MacBooks, and business PCs.',
                'meta_keywords'    => 'laptop, pc, macbook, desktop, workstation',
                'attributes'       => json_encode(['RAM', 'Storage', 'Processor', 'Display Size']),
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'gaming-laptops'],
            [
                'name'             => 'Gaming Laptops',
                'image'            => 'categories/gaming_laptops.jpg',
                'banner'           => 'categories/banners/gaming_laptops_banner.jpg',
                'icon'             => 'fa-gamepad',
                'is_menu'          => false,
                'is_active'        => true,
                'is_featured'      => true,
                'parent_id'        => $computers->id,
                'depth'            => 2,
                'order_priority'   => 1,
                'commission_rate'  => 12.00,
                'meta_title'       => 'High-End Gaming Laptops | RTX Graphics PCs',
                'meta_description' => 'Powerful gaming laptops featuring high refresh rate displays.',
                'meta_keywords'    => 'gaming, rtx, rog, alienware, gaming-laptop',
                'attributes'       => json_encode(['GPU', 'Screen Refresh Rate', 'Cooling Tech']),
            ]
        );

        // ============================================================
        // HIERARCHY 2: Fashion (2 Levels)
        // ============================================================
        $fashion = Category::updateOrCreate(
            ['slug' => 'fashion'],
            [
                'name'             => 'Fashion',
                'image'            => 'categories/fashion.jpg',
                'banner'           => 'categories/banners/fashion_banner.jpg',
                'icon'             => 'fa-shirt',
                'is_menu'          => true,
                'is_active'        => true,
                'is_featured'      => true,
                'parent_id'        => null,
                'depth'            => 0,
                'order_priority'   => 2,
                'commission_rate'  => 15.00,
                'meta_title'       => 'Fashion & Lifestyle Products',
                'meta_description' => 'Trending shoes, clothing, and stylish accessories.',
                'meta_keywords'    => 'clothing, footwear, shoes, fashion, apparel',
                'attributes'       => json_encode(['Size', 'Color', 'Material', 'Gender']),
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'mens-shoes'],
            [
                'name'             => "Men's Shoes",
                'image'            => 'categories/mens_shoes.jpg',
                'banner'           => 'categories/banners/mens_shoes_banner.jpg',
                'icon'             => 'fa-shoe-prints',
                'is_menu'          => true,
                'is_active'        => true,
                'is_featured'      => true,
                'parent_id'        => $fashion->id,
                'depth'            => 1,
                'order_priority'   => 1,
                'commission_rate'  => 12.00,
                'meta_title'       => "Men's Sneakers, Boots & Formal Shoes",
                'meta_description' => 'Step up your style with athletic sneakers and formal shoes.',
                'meta_keywords'    => 'shoes, sneakers, jordan, boots, footwear',
                'attributes'       => json_encode(['Shoe Size', 'Outer Material', 'Sole Material']),
            ]
        );

        // ============================================================
        // HIERARCHY 3: Digital Services (Standalone)
        // ============================================================
        Category::updateOrCreate(
            ['slug' => 'digital-services'],
            [
                'name'             => 'Digital Services',
                'image'            => 'categories/services.jpg',
                'banner'           => null,
                'icon'             => 'fa-globe',
                'is_menu'          => true,
                'is_active'        => true,
                'is_featured'      => false,
                'parent_id'        => null,
                'depth'            => 0,
                'order_priority'   => 3,
                'commission_rate'  => 20.00,
                'meta_title'       => 'Professional Digital & IT Services',
                'meta_description' => 'Web development, consultations, and digital strategy.',
                'meta_keywords'    => 'seo, web design, consultation, development',
                'attributes'       => json_encode(['Delivery Time', 'Revision Limit', 'Service Type']),
            ]
        );
    }
}