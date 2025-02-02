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
        Schema::create('products', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->string('code', 100);
            $table->string('name', 100);
            $table->string('unit', 100);
            $table->text('description');
            $table->unsignedInteger('stock');
            $table->unsignedBigInteger('price_sell');
            $table->text('image');

            $table->foreignUuid('company_id')->constrained('companies');

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
