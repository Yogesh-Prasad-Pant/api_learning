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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            
            $table->string('name')->index(); 
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();// sku = stock keepinng unit Global identifier for product in multiple shops;
            $table->string('unit')->default('piece');

            $table->text('description')->nullable();
            $table->string('catalog_image')->nullable();
            $table->string('video_url')->nullable();

            $table->json('attributes')->nullable();
            $table->boolean('has_variants')->default(false);

            $table->boolean('is_verified')->default(false)->index(); 
        
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
