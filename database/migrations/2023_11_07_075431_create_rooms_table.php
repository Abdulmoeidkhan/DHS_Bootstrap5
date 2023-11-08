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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_logged_by');
            $table->uuid('room_uid')->unique();
            $table->uuid('room_type')->unique();
            $table->string('room_no')->unique();
            $table->uuid('assign_to')->nullable();
            $table->uuid('gusest_delegation')->nullable();
            $table->string('room_checkin')->nullable();
            $table->string('room_checkout')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
