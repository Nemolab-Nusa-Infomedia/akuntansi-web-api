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
        Schema::create('sale_details', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->unsignedInteger('qty');
            $table->unsignedBigInteger('total');

            $table->foreignUuid('product_id')->constrained('products');
            $table->foreignUuid('sale_id')->constrained('sales');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
