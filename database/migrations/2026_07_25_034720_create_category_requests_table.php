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
        Schema::create('category_requests', function (Blueprint $table) {
            $table->id();
            // 1. Ownership & Context
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade'); // The shop owner/admin requesting

            // 2. Category Details Requested
            $table->string('name');
            $table->text('reason')->nullable(); // Why existing categories aren't sufficient

            // 3. Hierarchy Suggestion
            $table->foreignId('suggested_parent_id')->nullable()->constrained('categories')->nullOnDelete();

            // 4. Request Lifecycle Management
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->index();
            $table->text('admin_note')->nullable(); // Feedback or rejection reason from Superadmin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_requests');
    }
};
