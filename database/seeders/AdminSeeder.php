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
        Admin::create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@example.com',
            'password' => 'password123', 
            'role' => 'super_admin',
            'contact_no' => '123456789',
            'address' => '123 Super Street, Admin City', // Added address
        ]);

        // 2. Create a Regular Admin
        Admin::create([
            'name' => 'Regular Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'role' => 'admin',
            'contact_no' => '987654321',
            'address' => '456 Regular Ave, User Town', // Added address
        ]);
       
        
        //
    }
}
