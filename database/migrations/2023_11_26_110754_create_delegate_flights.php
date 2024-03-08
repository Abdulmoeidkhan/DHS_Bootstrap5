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
            $table->uuid('delegation_uid');
            $table->string('passport')->unique()->nullable();
            $table->string('arrival_date')->nullable();
            $table->string('arrival_time');
            $table->string('arrival_flight')->nullable();
            $table->string('departure_date')->nullable();
            $table->string('departure_time')->nullable();
            $table->string('departure_flight')->nullable();
            $table->uuid('flightsegment_uid');
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
