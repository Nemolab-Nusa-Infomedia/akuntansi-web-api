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
        Schema::create('product_restocks', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->integer('stock');
            $table->unsignedBigInteger('price_buy');
            $table->unsignedBigInteger('amount');

            $table->foreignUuid('product_id')->constrained('products');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_restocks');
    }
};
