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
        Schema::create('hotel_operator', function (Blueprint $table) {
            $table->id();
            $table->uuid('hotel_operator_uid')->unique();
            $table->uuid('hotel_uid')->unique();
            $table->string('hotel_code')->unique();
            $table->integer('hotel_operator_assign')->default(0);
            $table->uuid('hotel_operator_user')->unique()->nullable();
            $table->integer('hotel_operator_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_operator');
    }
};
