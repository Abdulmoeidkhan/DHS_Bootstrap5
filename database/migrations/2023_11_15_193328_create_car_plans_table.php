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
        Schema::create('car_plans', function (Blueprint $table) {
            $table->id();
            $table->uuid('delegation_uid');
            $table->uuid('car_plan_uid');
            $table->uuid('car_category_uid');
            $table->integer('car_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_plans');
    }
};
