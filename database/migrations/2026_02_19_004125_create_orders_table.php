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
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('subtotal',15,2);
            $table->decimal('shipping_cost',15,2)->default(0.00);
            $table->decimal('discount_amount',15,2)->default(0.00);
            $table->decimal('total_price',15,2);
            $table->enum('status',['pending','processing','shipped','delivered','cancelled','returned'])->default('pending')->index();
            $table->enum('payment_status',['unpaid','paid','partially','refunded'])->default('unpaid')->index();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable()->unique();
            $table->string('shipping_address')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('delivered_at')->nullable();
            $table->string('admin_note')->nullable();
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
