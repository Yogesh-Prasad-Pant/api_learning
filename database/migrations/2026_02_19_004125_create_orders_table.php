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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Unique tracking identifier for invoices & customer support
            $table->string('order_number')->unique()->index(); 
            
            // Multi-Vendor Isolation (Sub-order per shop model)
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Pricing Calculations
            $table->decimal('subtotal', 15, 2);
            $table->decimal('shipping_cost', 15, 2)->default(0.00);
            $table->decimal('discount_amount', 15, 2)->default(0.00);
            $table->decimal('total_price', 15, 2);
            
            // Platform vs. Vendor Revenue Ledger (Phase 3 Prep)
            $table->decimal('commission_rate', 5, 2)->default(0.00); // e.g., 10.00%
            $table->decimal('commission_amount', 15, 2)->default(0.00);
            $table->decimal('vendor_earning', 15, 2)->default(0.00);
            
            // Status Tracking
            $table->enum('status', [
                'pending', 
                'processing', 
                'shipped', 
                'delivered', 
                'cancelled', 
                'returned'
            ])->default('pending')->index();
            
            $table->enum('payment_status', [
                'unpaid', 
                'paid', 
                'partially_refunded', 
                'refunded'
            ])->default('unpaid')->index();
            
            $table->string('payment_method')->nullable(); // e.g., 'stripe', 'cod', 'khalti'
            $table->string('transaction_id')->nullable()->unique();
            
            // Historical Address Snapshots (Immutable once order is placed)
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->json('shipping_address'); // Full structured address snapshot
            $table->json('billing_address')->nullable();
            
            // Fulfillment Details
            $table->string('tracking_number')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            
            // Notes & Logs
            $table->text('customer_note')->nullable();
            $table->text('admin_note')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
