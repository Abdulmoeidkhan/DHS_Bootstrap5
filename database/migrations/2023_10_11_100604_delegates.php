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
            $table->uuid('rank')->nullable();
            $table->integer('self')->default(1);
            $table->uuid('delegation');
            $table->integer('status')->default(1);
            $table->string('delegation_type')->default('Member');
            $table->string('last_Name')->nullable();
            $table->string('first_Name')->nullable();
            $table->string('designation')->nullable();
            $table->string('delegateCode')->unique();
            $table->string('itinerary_uid')->nullable();
            $table->integer('invitation_number')->nullable()->unique();
            $table->uuid('accomodated')->nullable();
            $table->uuid('car_accomodated')->nullable();
            // $table->string('organistaion')->nullable();
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
