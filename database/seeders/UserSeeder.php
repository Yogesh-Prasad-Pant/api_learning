<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Primary Customer Account
        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name'     => 'Test Customer',
                'password' => Hash::make('password'),
                'phone'    => '9841234567',
                'city'     => 'Kathmandu',
                'address'  => 'Baneshwor, Ward 10',
                'status'   => 'active',
            ]
        );

        // Secondary Customer Account
        User::updateOrCreate(
            ['email' => 'aayush.shrestha@example.com'],
            [
                'name'     => 'Aayush Shrestha',
                'password' => Hash::make('password'),
                'phone'    => '9808123456',
                'city'     => 'Lalitpur',
                'address'  => 'Jhamsikhel, Ward 3',
                'status'   => 'active',
            ]
        );

        // Standard Factory Fallback User
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name'     => 'Test User',
                'password' => Hash::make('password'),
                'phone'    => '9812345678',
                'city'     => 'Bhaktapur',
                'address'  => 'Suryabinayak',
                'status'   => 'active',
            ]
        );
    }
}