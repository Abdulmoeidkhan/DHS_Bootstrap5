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
            $table->uuid('room_type');
            $table->string('room_logged_by');
            $table->uuid('room_uid')->unique();
            $table->uuid('hotel_uid')->nullable();
            $table->string('room_no')->unique();
            $table->uuid('assign_to')->nullable();
            $table->date('room_checkin')->nullable();
            $table->date('room_checkout')->nullable();
            $table->integer('checked_in_time')->nullable();
            $table->integer('checked_out_time')->nullable();
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
