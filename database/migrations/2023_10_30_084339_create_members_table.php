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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->uuid('delegation');
            $table->uuid('member_uid')->unique();
            $table->string('member_first_Name');
            $table->string('member_last_Name');
            $table->string('member_designation');
            $table->string('member_organistaion');
            $table->string('member_rank');
            $table->string('member_passport')->nullable();
            $table->integer('member_status')->default(1);
            $table->uuid('accomodated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
