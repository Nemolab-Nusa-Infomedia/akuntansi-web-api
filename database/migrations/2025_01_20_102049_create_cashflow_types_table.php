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
        Schema::create('cashflow_types', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            $table->string('name', 100);
            $table->string('type', 100);
        });

        Schema::table('cashflows', function (Blueprint $table): void {
            $table->foreignUuid('cashflow_type_id')->after('transaction_id')->constrained('cashflow_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cashflows', function (Blueprint $table): void {
            $table->dropForeign(['cashflow_type_id']);
        });

        Schema::dropIfExists('cashflow_types');
    }
};
