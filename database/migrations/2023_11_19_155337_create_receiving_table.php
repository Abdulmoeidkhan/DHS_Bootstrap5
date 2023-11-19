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
        Schema::create('receiving', function (Blueprint $table) {
            $table->id();
            $table->uuid('receiving_uid')->unique();
            $table->string('receiving_rank');
            $table->string('receiving_designation');
            $table->string('receiving_first_name');
            $table->string('receiving_last_name');
            $table->bigInteger('receiving_contact');
            $table->bigInteger('receiving_identity')->unique();
            $table->uuid('receiving_delegation')->unique()->nullable();
            $table->uuid('receiving_officer')->unique()->nullable();
            $table->string('receivingCode')->unique();
            $table->string('receiving_assign')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receiving');
    }
};
