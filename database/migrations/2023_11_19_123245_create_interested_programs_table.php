<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interested_programs', function (Blueprint $table) {
            $table->id();
            $table->uuid('interest_uid')->unique();
            $table->uuid('guest_uid');
            $table->uuid('program_uid');
            $table->uuid('delegation_uid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interested_programs');
    }
};
