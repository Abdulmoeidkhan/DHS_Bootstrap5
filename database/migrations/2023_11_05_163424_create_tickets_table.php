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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid('ticket_uid')->unique();
            $table->string('ticket_remarks')->nullable();
            $table->uuid('itinerary_uid');
            $table->uuid('passenger_uid')->unique();
            $table->bigInteger('ticket_number')->nullable();
            $table->integer('ticket_status')->default(1);
            $table->string('coupon_status')->default('Open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
