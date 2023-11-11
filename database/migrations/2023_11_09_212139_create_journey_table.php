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
        Schema::create('journey', function (Blueprint $table) {
            $table->id();
            $table->uuid('car_uid')->unique();
            $table->uuid('journey_logged_by');
            $table->uuid('journey_uid')->unique();
            $table->string('journey_pickup')->nullable();
            $table->string('journey_dropoff')->nullable();
            $table->uuid('journey_assign_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journey');
    }
};
