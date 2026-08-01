<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $john  = Admin::where('email', 'vendor1@shop.com')->first();
        $sarah = Admin::where('email', 'vendor2@shop.com')->first();

        if ($john) {
            // Shop 1: Electronics & Computers
            Shop::updateOrCreate(
                ['slug' => 'johns-tech-world'],
                [
                    'admin_id'         => $john->id,
                    'shop_name'        => 'Johns Tech World',
                    'description'      => 'Authorized retailer for high-performance laptops, monitors, smart devices, and computing peripherals in Kathmandu.',
                    'logo'             => 'shops/logos/johns_tech.png',
                    'cover_image'      => 'shops/covers/johns_tech_banner.jpg',
                    'theme_color'      => '#0d6efd',
                    'business_email'   => 'tech@johns.com',
                    'contact_no'       => '9801112221',
                    'address'          => 'New Road Plaza, 2nd Floor, Kathmandu',
                    'map_location'     => 'https://maps.google.com/?q=27.7007,85.3123',
                    'latitude'         => 27.70070000,
                    'longitude'        => 85.31230000,
                    'status'           => 'active',
                    'is_featured'      => true,
                    'is_open'          => true,
                    'opening_hours'    => json_encode([
                        'monday'    => '10:00-19:00',
                        'tuesday'   => '10:00-19:00',
                        'wednesday' => '10:00-19:00',
                        'thursday'  => '10:00-19:00',
                        'friday'    => '10:00-19:00',
                        'saturday'  => '11:00-17:00',
                        'sunday'    => 'Closed',
                    ]),
                    'rating'           => 4.85,
                    'reviews_count'    => 142,
                    'commission_rate'  => 10.00,
                    'balance'          => 125000.50,
                    'social_links'     => json_encode([
                        'facebook'  => 'https://facebook.com/johnstechworld',
                        'instagram' => 'https://instagram.com/johnstechworld',
                    ]),
                    'meta_title'       => 'Johns Tech World | Premium Computers & Electronics Nepal',
                    'meta_description' => 'Buy genuine electronics, laptops, and monitors with warranty at Johns Tech World, New Road.',
                ]
            );

            // Shop 2: Organic Groceries
            Shop::updateOrCreate(
                ['slug' => 'johns-fresh-mart'],
                [
                    'admin_id'         => $john->id,
                    'shop_name'        => "John's Fresh Mart",
                    'description'      => 'Farm-fresh organic vegetables, imported fruits, dairy, and essential household items delivered daily.',
                    'logo'             => 'shops/logos/fresh_mart.png',
                    'cover_image'      => 'shops/covers/fresh_mart_banner.jpg',
                    'theme_color'      => '#198754',
                    'business_email'   => 'fresh@johns.com',
                    'contact_no'       => '9801112222',
                    'address'          => 'Mid-Baneshwor Main Road, Kathmandu',
                    'map_location'     => 'https://maps.google.com/?q=27.6915,85.3420',
                    'latitude'         => 27.69150000,
                    'longitude'        => 85.34200000,
                    'status'           => 'active',
                    'is_featured'      => false,
                    'is_open'          => true,
                    'opening_hours'    => json_encode([
                        'daily' => '07:00-21:00',
                    ]),
                    'rating'           => 4.70,
                    'reviews_count'    => 98,
                    'commission_rate'  => 5.00,
                    'balance'          => 45200.00,
                    'social_links'     => json_encode([
                        'instagram' => 'https://instagram.com/johnsfreshmart',
                    ]),
                    'meta_title'       => "John's Fresh Mart | Daily Organic Grocery Delivery",
                    'meta_description' => 'Order fresh vegetables, fruits, and groceries online in Baneshwor, Kathmandu.',
                ]
            );
        }

        if ($sarah) {
            // Shop 3: Apparel & Fashion
            Shop::updateOrCreate(
                ['slug' => 'sarahs-boutique'],
                [
                    'admin_id'         => $sarah->id,
                    'shop_name'        => "Sarah's Boutique",
                    'description'      => 'Curated collection of high-street fashion, designer footwear, formal wear, and accessories for men and women.',
                    'logo'             => 'shops/logos/sarahs_boutique.png',
                    'cover_image'      => 'shops/covers/sarahs_boutique_banner.jpg',
                    'theme_color'      => '#dc3545',
                    'business_email'   => 'style@sarahs.com',
                    'contact_no'       => '9801112223',
                    'address'          => 'Lazimpat Rd, Near Standard Chartered, Kathmandu',
                    'map_location'     => 'https://maps.google.com/?q=27.7215,85.3210',
                    'latitude'         => 27.72150000,
                    'longitude'        => 85.32100000,
                    'status'           => 'active',
                    'is_featured'      => true,
                    'is_open'          => true,
                    'opening_hours'    => json_encode([
                        'mon-sat' => '10:00-20:00',
                        'sunday'  => '12:00-18:00',
                    ]),
                    'rating'           => 4.95,
                    'reviews_count'    => 310,
                    'commission_rate'  => 12.00,
                    'balance'          => 89400.75,
                    'social_links'     => json_encode([
                        'facebook'  => 'https://facebook.com/sarahsboutiquenepal',
                        'instagram' => 'https://instagram.com/sarahsboutiquenepal',
                        'tiktok'    => 'https://tiktok.com/@sarahsboutique',
                    ]),
                    'meta_title'       => "Sarah's Boutique | Modern Fashion & Footwear",
                    'meta_description' => 'Discover trending footwear, sneakers, and apparel at Sarahs Boutique, Lazimpat.',
                ]
            );
        }
    }
}