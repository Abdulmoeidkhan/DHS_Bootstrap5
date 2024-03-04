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
        Schema::create('car_operators', function (Blueprint $table) {
            $table->uuid('car_operator_uid')->unique();
            $table->integer('car_operator_assign')->default(0);
            $table->uuid('car_operator_user')->unique()->nullable();
            $table->integer('car_operator_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_operators');
    }
};
