<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Contact;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('pt_name', 100);
            $table->string('phone', 100);
            $table->enum('identity', [
                Contact::PASPOR,
                Contact::KTP,
                Contact::SIM,
            ]);
            $table->text('billing_address');
            $table->text('payment_address');
            $table->string('name_bank', 100);
            $table->string('no_bank', 100);
            $table->boolean('status');

            $table->timestamps();
        });

        Schema::table('sales', function (Blueprint $table): void {
            $table->foreignUuid('contact_id')->after('transaction_id')->constrained('contacts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table): void {
            $table->dropForeign(['contact_id']);
        });

        Schema::dropIfExists('contacts');
    }
};
