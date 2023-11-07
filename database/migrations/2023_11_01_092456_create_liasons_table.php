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
        Schema::create('liasons', function (Blueprint $table) {
            $table->id();
            $table->uuid('liason_uid')->unique();
            $table->string('liason_rank');
            $table->string('liason_designation');
            $table->string('liason_first_name');
            $table->string('liason_last_name');
            $table->bigInteger('liason_contact');
            $table->bigInteger('liason_identity')->unique();
            $table->uuid('liason_delegation')->unique()->nullable();
            $table->uuid('liason_officer')->unique()->nullable();
            $table->string('liasonCode')->unique();
            $table->string('liason_assign')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liasons');
    }
};
