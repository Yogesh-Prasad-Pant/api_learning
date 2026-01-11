<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // 1. THE SUPERADMIN
        Admin::create([
            'name' => 'Main Superadmin',
            'email' => 'super@marketplace.com',
            'email_verified_at' => now(),
            'password' => 'superpassword',
            'role' => 'superadmin',
            'status' => 'active',
            'kyc_status' => 'verified',
            'is_verified' => true,
            'contact_no' => '9801112223',
        ]);

        // 2. VENDOR ONE: Already Active & Verified
        Admin::create([
            'name' => 'Electronics Expert',
            'email' => 'vendor1@shop.com',
            'email_verified_at' => now(),
            'password' => 'password123',
            'role' => 'admin',
            'status' => 'active',
            'kyc_status' => 'verified',
            'is_verified' => true,
            'contact_no' => '9841000001',
            'address' => 'New Road, Kathmandu',
            'id_proof_type' => 'Citizenship',
            'id_proof_path' => 'kyc/id_proofs/vendor1.jpg',
        ]);

        // 3. VENDOR TWO: New & Pending (To test Superadmin approval)
        Admin::create([
            'name' => 'Fashion Forward',
            'email' => 'vendor2@shop.com',
            'email_verified_at' => now(),
            'password' => 'password123',
            'role' => 'admin',
            'status' => 'pending',
            'kyc_status' => 'pending',
            'is_verified' => false,
            'contact_no' => '9841000002',
            'address' => 'Baneshwor, Kathmandu',
            'id_proof_type' => 'Passport',
            'id_proof_path' => 'kyc/id_proofs/vendor2.jpg',
        ]);
       
        
        //
    }
}
