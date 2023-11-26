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
        Schema::create('delegate_flights', function (Blueprint $table) {
            $table->id();
            $table->uuid('delegate_uid')->unique();
            $table->string('passport')->unique();
            $table->string('arrival_date');
            $table->string('arrival_time');
            $table->string('departure_date');
            $table->string('departure_time');
            $table->string('passport')->unique();
            $table->uuid('flightsegment_uid')->unique();
            $table->string('arrived')->default(0);
            $table->string('departed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegate_flights');
    }
};
