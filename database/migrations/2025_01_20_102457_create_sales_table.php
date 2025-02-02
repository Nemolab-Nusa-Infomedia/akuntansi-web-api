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
        Schema::create('sales', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->string('no_transaction', 100);
            $table->date('transaction_date');
            $table->date('due_date');
            $table->string('payment_team', 100);
            $table->string('attachment', 100);
            $table->string('memo', 100);
            $table->unsignedBigInteger('subtotal');
            $table->unsignedBigInteger('total');

            $table->foreignUuid('transaction_id')->constrained('transactions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
