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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_makes');
            $table->string('car_model');
            $table->string('car_category');
            $table->uuid('car_uid')->unique();
            $table->string('car_number')->unique();
            $table->uuid('driver_uid')->nullable()->unique();
            $table->string('car_remarks')->nullable();
            $table->string('car_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
