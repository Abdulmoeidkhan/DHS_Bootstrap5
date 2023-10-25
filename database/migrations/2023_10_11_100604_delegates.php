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
            $table->uuid('user_uid')->unique();
            $table->string('country')->nullable();
            $table->string('rep_first_Name')->nullable();
            $table->string('rep_last_Name')->nullable();
            $table->integer('self')->default(1);
            $table->string('rank')->nullable();
            $table->string('first_Name')->nullable();
            $table->string('last_Name')->nullable();
            $table->uuid('delegation')->unique();
            $table->string('designation')->nullable();
            $table->string('organistaion')->nullable();
            $table->string('passport')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
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