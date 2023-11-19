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
        Schema::create('interpreters', function (Blueprint $table) {
            $table->id();
            $table->uuid('interpreter_uid')->unique();
            $table->string('interpreter_rank');
            $table->string('interpreter_designation');
            $table->string('interpreter_first_name');
            $table->string('interpreter_last_name');
            $table->bigInteger('interpreter_contact');
            $table->bigInteger('interpreter_identity')->unique();
            $table->uuid('interpreter_delegation')->unique()->nullable();
            $table->uuid('interpreter_officer')->unique()->nullable();
            $table->string('interpreterCode')->unique();
            $table->string('interpreter_assign')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interpreters');
    }
};
