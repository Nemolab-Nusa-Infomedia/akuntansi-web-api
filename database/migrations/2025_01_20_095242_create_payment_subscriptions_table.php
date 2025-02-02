<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PaymentSubscription;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_subscriptions', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->unsignedBigInteger('amount');
            $table->enum('status', [
                PaymentSubscription::PENDING,
                PaymentSubscription::SUCCESS,
                PaymentSubscription::FAILED,
            ])->default(PaymentSubscription::PENDING);

            $table->foreignUuid('subscription_id')->constrained('subscriptions');
            $table->foreignUuid('company_id')->constrained('companies');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_subscriptions');
    }
};
