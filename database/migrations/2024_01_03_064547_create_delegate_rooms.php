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
            $table->uuid('delegate_uid')->unique();
            $table->string('room_no')->unique();
            $table->string('arrival_date');
            $table->string('arrival_flight');
            $table->string('departure_date');
            $table->string('departure_flight');
            $table->uuid('room_booked_uid')->unique();
            $table->string('checked_in')->default(0);
            $table->string('checked_in_time');
            $table->string('checked_out')->default(0);
            $table->string('checked_out_time');
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
