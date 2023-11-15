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
        Schema::create('hotelplan', function (Blueprint $table) {
            $table->id();
            $table->uuid('delegation_uid');
            $table->uuid('hotel_plan_uid');
            $table->uuid('hotel_category_uid');
            $table->integer('hotel_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotelplan');
    }
};
