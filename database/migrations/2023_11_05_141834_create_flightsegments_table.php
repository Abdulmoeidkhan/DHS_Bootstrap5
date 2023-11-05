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
        Schema::create('flightsegments', function (Blueprint $table) {
            $table->id();
            $table->string('flight_no');
            $table->string('airline');
            $table->string('arrival_city');
            $table->string('arrival_date');
            $table->string('arrival_time');
            $table->string('departure_city');
            $table->string('departure_date');
            $table->string('departure_time');
            $table->uuid('itinerary_uid')->nullable();
            $table->uuid('flightsegment_uid')->unique();
            $table->string('flight_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flightsegments');
    }
};
