<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Admin::create([
        'name' => 'Rabin Dc',
        'email' => 'admin@shop.com',
        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        'role' => 'admin',
        'contact_no' => '9800000000',
        'address' => 'Kathmandu, Nepal',
        'status' => 'active',
    ]);
        //
    }
}
