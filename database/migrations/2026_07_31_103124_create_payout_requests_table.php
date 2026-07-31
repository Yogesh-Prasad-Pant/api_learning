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
        Schema::create('payout_requests', function (Blueprint $table) {
            $table->id();
            
            // Reference to the shop requesting payout
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            
            // Amount requested
            $table->decimal('amount', 15, 2);
            
            // Payment details (e.g. Bank Account Number, eSewa ID, Khalti ID, etc.)
            $table->string('payment_method'); // ESEWA, KHALTI, BANK_TRANSFER
            $table->json('payment_details');
            
            // Lifecycle Status
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending')->index();
            
            // Superadmin decision notes (rejection reason or payout transaction ref)
            $table->text('admin_note')->nullable();
            $table->timestamp('processed_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payout_requests');
    }
};