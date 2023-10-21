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
            $table->uuid('user_uid')->unique();
            $table->string('name')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days');
            $table->string('venue');
            $table->string('description')->nullable();
            $table->string('delegations')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('user_uid')->references('uid')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
