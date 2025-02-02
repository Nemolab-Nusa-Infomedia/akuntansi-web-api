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
        Schema::create('subscriptions', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->string('name', 100);
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('duration');
            $table->text('description');
            $table->string('duration_text', 100);

            $table->timestamps();
        });

        Schema::table('companies', function (Blueprint $table): void {
            $table->foreignUuid('subscription_id')->after('location')->constrained('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
