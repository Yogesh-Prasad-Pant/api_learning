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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();

            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_menu')->default(false);

            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_featured')->default(false)->index();
            
            
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->integer('depth')->default(0);
            $table->integer('order_priority')->default(0)->index();

            $table->decimal('commission_rate', 5, 2)->default(0.00); 
 
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->json('attributes')->nullable();

            

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
