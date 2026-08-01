<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Superadmin Account
        Admin::updateOrCreate(
            ['email' => 'super@marketplace.com'],
            [
                'name'              => 'Main Superadmin',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'super_admin',
                'status'            => 'active',
                'kyc_status'        => 'verified',
                'is_verified'       => true,
                'contact_no'        => '9801112223',
                'address'           => 'Durbar Marg, Kathmandu',
                'id_proof_type'     => 'Citizenship',
                'id_proof_path'     => 'kyc/id_proofs/superadmin_id.pdf',
            ]
        );

        // 2. Vendor One: Active & Fully Verified
        Admin::updateOrCreate(
            ['email' => 'vendor1@shop.com'],
            [
                'name'              => 'John Doe',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'admin',
                'status'            => 'active',
                'kyc_status'        => 'verified',
                'is_verified'       => true,
                'contact_no'        => '9841000001',
                'address'           => 'New Road, Kathmandu',
                'id_proof_type'     => 'Citizenship',
                'id_proof_path'     => 'kyc/id_proofs/vendor1_citizenship.jpg',
            ]
        );

        // 3. Vendor Two: Active & Verified
        Admin::updateOrCreate(
            ['email' => 'vendor2@shop.com'],
            [
                'name'              => 'Sarah Jenkins',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
                'role'              => 'admin',
                'status'            => 'active',
                'kyc_status'        => 'verified',
                'is_verified'       => true,
                'contact_no'        => '9841000002',
                'address'           => 'Lazimpat, Kathmandu',
                'id_proof_type'     => 'Passport',
                'id_proof_path'     => 'kyc/id_proofs/vendor2_passport.jpg',
            ]
        );

        // 4. Vendor Three: Pending Approval (Testing Workflow)
        Admin::updateOrCreate(
            ['email' => 'vendor3@shop.com'],
            [
                'name'              => 'Rajesh Sharma',
                'email_verified_at' => null,
                'password'          => Hash::make('password123'),
                'role'              => 'admin',
                'status'            => 'pending',
                'kyc_status'        => 'pending',
                'is_verified'       => false,
                'contact_no'        => '9841000003',
                'address'           => 'Patan, Lalitpur',
                'id_proof_type'     => 'Driving License',
                'id_proof_path'     => 'kyc/id_proofs/vendor3_license.jpg',
            ]
        );
    }
}