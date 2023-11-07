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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->uuid('hotel_uid')->unique();
            $table->string('hotel_names')->unique();
            $table->string('hotel_address')->nullable();
            $table->string('contact_person')->unique();
            $table->bigInteger('contact_number')->unique();
            $table->string('hotel_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
