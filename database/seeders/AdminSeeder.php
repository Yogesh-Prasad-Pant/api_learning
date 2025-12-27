<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Aarav Sharma',
                
                'contact_no' => '9841000001',
                'address' => 'Kathmandu, Nepal',
                'role' => 'super_admin', // Overriding default
            ],
            [
                'name' => 'Emma Watson',
                'email' => 'emma@example.com',
                'image' => 'admins/default.png',
                'password' => 'password123',
                'contact_no' => '9841000002',
                'address' => 'London, UK',
                'role' => 'manager',
            ],
            [
                'name' => 'Liam Chen',
                'email' => 'liam@example.com',
                'image' => 'admins/default.png',
                'password' => 'password123',
                'contact_no' => '9841000003',
                'address' => 'Singapore',
                'role' => 'editor',
            ],
            [
                'name' => 'Sofia Rodriguez',
                'email' => 'sofia@example.com',
                'image' => 'admins/default.png',
                'password' => 'password123',
                'contact_no' => '9841000004',
                'address' => 'Madrid, Spain',
                'role' => 'admin', // Matches your default
            ],
            [
                'name' => 'Yuki Tanaka',
                'email' => 'yuki@example.com',
                'image' => 'admins/default.png',
                'password' => 'password123',
                'contact_no' => '9841000005',
                'address' => 'Tokyo, Japan',
                'role' => 'support',
            ],
        ];

        foreach ($admins as $adminData) {
            // Using forceCreate to ensure 'role' is saved despite $fillable restrictions
            Admin::forceCreate($adminData);
        }
        //
    }
}
