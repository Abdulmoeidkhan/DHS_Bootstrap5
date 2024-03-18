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
        Schema::create('officers', function (Blueprint $table) {
            $table->id();
            $table->uuid('officer_uid')->unique();
            $table->string('officer_rank');
            $table->string('officer_designation');
            $table->string('officer_first_name');
            $table->string('officer_last_name');
            $table->string('officer_address');
            $table->string('officer_remarks');
            $table->string('officer_contact');
            $table->string('officer_identity')->unique();
            $table->uuid('officer_delegation')->unique()->nullable();
            $table->uuid('officer_user')->unique()->nullable();
            $table->uuid('officer_type');
            $table->string('officerCode')->unique();
            $table->integer('officer_assign')->default(0);
            $table->integer('officer_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officers');
    }
};
