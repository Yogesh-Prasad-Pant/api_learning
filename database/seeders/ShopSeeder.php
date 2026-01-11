<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // OWNER 1: John (Admin ID 2) - Owns 2 Shops
        
        // Shop 1: Electronics
        Shop::create([
            'admin_id' => 2,
            'shop_name' => 'Johns Tech World',
            'slug' => 'johns-tech-world',
            'description' => 'Premium electronics and gadgets store.',
            'logo' => 'shops/logos/tech.png',
            'cover_image' => 'shops/covers/tech_bg.jpg',
            'theme_color' => '#0044ff',
            'business_email' => 'tech@johns.com',
            'contact_no' => '9801112221',
            'address' => 'New Road, Kathmandu',
            'map_location' => 'https://maps.google.com/?q=27.7007,85.3123',
            'latitude' => 27.70070000,
            'longitude' => 85.31230000,
            'status' => 'active',
            'is_featured' => true,
            'is_open' => true,
            'opening_hours' => json_encode(['mon-fri' => '09:00-18:00', 'sat' => '10:00-14:00']),
            'rating' => 4.50,
            'reviews_count' => 120,
            'commission_rate' => 10.00, // Superadmin controlled
            'balance' => 1500.50,
            'social_links' => json_encode(['facebook' => 'fb.com/johnstech']),
            'meta_title' => 'Best Electronics in Kathmandu',
            'meta_description' => 'Buy the latest tech at Johns Tech World.',
        ]);

        // Shop 2: Groceries (Same Admin ID 2)
        Shop::create([
            'admin_id' => 2,
            'shop_name' => 'Johns Fresh Mart',
            'slug' => 'johns-fresh-mart',
            'description' => 'Fresh organic vegetables and daily groceries.',
            'logo' => 'shops/logos/grocery.png',
            'cover_image' => 'shops/covers/grocery_bg.jpg',
            'theme_color' => '#28a745',
            'business_email' => 'fresh@johns.com',
            'contact_no' => '9801112222',
            'address' => 'Baneshwor, Kathmandu',
            'map_location' => 'https://maps.google.com/?q=27.6915,85.3420',
            'latitude' => 27.69150000,
            'longitude' => 85.34200000,
            'status' => 'active',
            'is_featured' => false,
            'is_open' => true,
            'opening_hours' => json_encode(['daily' => '07:00-21:00']),
            'rating' => 4.80,
            'reviews_count' => 85,
            'commission_rate' => 5.00, // Lower commission for groceries
            'balance' => 3200.00,
            'social_links' => json_encode(['instagram' => 'instagr.am/johnsfresh']),
            'meta_title' => 'Organic Groceries Online',
            'meta_description' => 'Fresh vegetables delivered to your door.',
        ]);

        // OWNER 2: Sarah (Admin ID 3) - Owns 1 Shop
        Shop::create([
            'admin_id' => 3,
            'shop_name' => 'Sarahs Boutique',
            'slug' => 'sarahs-boutique',
            'description' => 'Exclusive designer wear for every occasion.',
            'logo' => 'shops/logos/fashion.png',
            'cover_image' => 'shops/covers/fashion_bg.jpg',
            'theme_color' => '#e83e8c',
            'business_email' => 'style@sarahs.com',
            'contact_no' => '9801112223',
            'address' => 'Lazimpat, Kathmandu',
            'map_location' => null,
            'latitude' => 27.72150000,
            'longitude' => 85.32100000,
            'status' => 'active',
            'is_featured' => true,
            'is_open' => true,
            'opening_hours' => json_encode(['mon-sat' => '10:00-20:00']),
            'rating' => 4.90,
            'reviews_count' => 450,
            'commission_rate' => 15.00,
            'balance' => 12500.75,
            'social_links' => null,
            'meta_title' => 'Designer Fashion Nepal',
            'meta_description' => 'Sarahs Boutique offers the best fashion.',
        ]);
    }
}
