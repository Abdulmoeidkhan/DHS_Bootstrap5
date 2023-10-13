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
            $table->uuid('uid')->unique();
            $table->string('country');
            $table->integer('self')->default(1);
            $table->string('rank');
            $table->string('first_Name');
            $table->string('last_Name');
            $table->integer('delegation');
            $table->string('designation')->nullable();
            $table->string('organistaion')->nullable();
            $table->string('passport')->nullable();
            $table->timestamps();
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
