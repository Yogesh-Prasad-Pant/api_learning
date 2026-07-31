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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('payment_method'); // ESEWA, KHALTI, COD (Cash on Delivery), STORE_PAYMENT
            $table->string('transaction_code')->nullable(); // eSewa Ref ID or Gateway Transaction ID
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('PENDING'); // PENDING, COMPLETED, FAILED, REFUNDED
            $table->json('raw_response')->nullable(); // Full payload response from gateway for auditing
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
