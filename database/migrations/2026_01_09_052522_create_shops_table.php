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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            
            $table->string('shop_name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('theme_color')->default('#4A90E2');

            $table->string('business_email')->nullable();
            $table->string('contact_no')->nullable();
            $table->text('address')->nullable();
            
            $table->string('map_location')->nullable();
            $table->decimal('latitude', 10, 8)->nullable()->index();
            $table->decimal('longitude', 11, 8)->nullable()->index();

            $table->enum( 'status', ['pending', 'active', 'inactive', 'suspended'])->default('pending')->index();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_open')->default(true);
            $table->json('opening_hours')->nullable();

            $table->decimal('rating',3, 2)->default(0.00);
            $table->integer('reviews_count')->default(0);


            $table->decimal('commission_rate', 5, 2)->default(0.00); 
            $table->decimal('balance', 15, 2)->default(0.00);

            $table->json('social_links')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();


            $table->softDeletes();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
