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
        Schema::create('transactions', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->date('date');
            $table->unsignedBigInteger('amount');
            $table->text('description');

            $table->foreignUuid('company_id')->constrained('companies');
            $table->foreignUuid('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
