<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->string('name', 100);

            $table->foreignUuid('company_id')->constrained('companies');

            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table): void {
            $table->foreignUuid('category_id')->after('company_id')->constrained('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
