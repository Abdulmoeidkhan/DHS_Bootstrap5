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
        Schema::create('delegates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('delegates_uid')->unique();
            $table->string('rank')->nullable();
            $table->uuid('user_uid')->nullable()->unique();
            $table->integer('self')->default(1);
            $table->uuid('rep_uid')->nullable();
            $table->uuid('delegation')->unique();
            $table->integer('status')->default(1);
            $table->string('country')->nullable();
            $table->string('passport')->nullable();
            $table->string('last_Name')->nullable();
            $table->string('first_Name')->nullable();
            $table->string('designation')->nullable();
            $table->string('organistaion')->nullable();
            $table->string('itinerary_uid')->nullable();
            $table->string('rep_last_Name')->nullable();
            $table->string('rep_first_Name')->nullable();
            $table->uuid('accomodated')->nullable();
            $table->uuid('car_accomodated')->nullable();
            // $table->foreign('user_uid')->references('uid')->on('users')
            // ->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('delegation')->references('id')->on('delegations')
            // ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegates');
    }
};
