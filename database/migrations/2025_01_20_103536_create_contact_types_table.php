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
        Schema::create('contact_types', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->string('name', 100);

            $table->timestamps();
        });

        Schema::table('contacts', function (Blueprint $table): void {
            $table->foreignUuid('type_id')->after('status')->constrained('contact_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table): void {
            $table->dropForeign(['type_id']);
        });

        Schema::dropIfExists('contact_types');
    }
};
