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
        Schema::create('hotel_plans', function (Blueprint $table) {
            $table->id();
            $table->uuid('delegation_uid');
            $table->uuid('hotel_plan_uid');
            $table->integer('hotel_roomtype_standard');
            $table->string('hotel_roomtype_standard_details');
            $table->integer('hotel_roomtype_suite');
            $table->string('hotel_roomtype_suite_details');
            $table->integer('hotel_roomtype_superior');
            $table->string('hotel_roomtype_superior_details');
            $table->integer('hotel_roomtype_doubleOccupancy');
            $table->string('hotel_roomtype_doubleOccupancy_details');
            $table->uuid('hotel_uid');
            $table->integer('hotel_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_plans');
    }
};
