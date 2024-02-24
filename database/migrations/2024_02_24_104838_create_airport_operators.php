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
        Schema::create('airport_operators', function (Blueprint $table) {
            $table->id();
            $table->uuid('airport_operator_uid')->unique();
            $table->integer('airport_operator_assign')->default(0);
            $table->uuid('airport_operator_user')->unique()->nullable();
            $table->integer('airport_operator_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airport_operators');
    }
};
