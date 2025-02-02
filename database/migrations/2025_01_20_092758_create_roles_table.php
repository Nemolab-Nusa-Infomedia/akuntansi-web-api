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
        Schema::create('roles', function (Blueprint $table): void {
            $table->uuid('id')->primary();

            // REQUIRED
            $table->string('name', 100);

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table): void {
            $table->foreignUuid('role_id')->after('status_account')->constrained('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
