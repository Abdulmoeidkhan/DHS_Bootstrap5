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
        Schema::create('delegate_rooms', function (Blueprint $table) {
            $table->id();
            $table->uuid('room_booked_uid')->unique();
            $table->string('hotel_plan_uid');
            $table->string('room_nos')->nullable();
            $table->string('checked_in')->default(0);
            $table->string('checked_in_time')->nullable();
            $table->string('checked_out')->default(0);
            $table->string('checked_out_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegate_rooms');
    }
};
