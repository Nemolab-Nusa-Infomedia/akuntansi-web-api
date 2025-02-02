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
        Schema::create('company_categories', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->string('name', 100);

            $table->timestamps();
        });

        Schema::table('companies', function (Blueprint $table): void {
            $table->foreignUuid('category_id')->after('location')->constrained('company_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_categories');
    }
};
