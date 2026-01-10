<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->nullable();

            $table->string('role')->default('admin'); 
            $table->enum('status', ['pending', 'active', 'suspended'])->default('pending')->index(); 
            $table->enum('kyc_status', ['not_submitted', 'pending', 'verified', 'rejected'])->default('not_submitted')->index();
            $table->boolean('is_verified')->default(false)->index();
            
            $table->string('contact_no')->nullable();
            $table->text('address')->nullable();

            $table->string('id_proof_type')->nullable();
            $table->string('id_proof_path')->nullable();
            $table->string('business_license_path')->nullable();
            $table->text('kyc_notes')->nullable(); 

            $table->string('password');
            $table->ipAddress('last_login_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();

            $table->string('referred_by')->nullable();
            
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
