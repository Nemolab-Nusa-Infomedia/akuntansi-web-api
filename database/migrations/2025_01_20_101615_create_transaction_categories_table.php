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
        Schema::create('transaction_categories', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->string('name', 100);
            $table->string('type', 100);
        });

        Schema::table('transactions', function (Blueprint $table): void {
            $table->foreignUuid('transaction_category_id')->after('user_id')->constrained('transaction_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table): void {
            $table->dropForeign(['transaction_category_id']);
        });

        Schema::dropIfExists('transaction_categories');
    }
};
