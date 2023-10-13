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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days');
            $table->string('venue')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('description')->nullable();
            $table->string('delegations')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
