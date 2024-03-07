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
        Schema::create('delegations', function (Blueprint $table) {
            // $table->string('last_Name')->nullable();
            // $table->string('first_Name')->nullable();
            // $table->string('designation')->nullable();
            // $table->uuid('rank')->nullable();
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('country');
            $table->uuid('user_uid')->nullable()->unique();
            $table->string('invited_by');
            $table->string('email_address')->unique();
            $table->string('delegation_response')->default("Awaited");
            $table->string('address')->nullable();
            $table->string('exhibition');
            $table->string('delegationCode')->unique();
            $table->uuid('delegationhead')->unique()->nullable();
            $table->integer('delegation_status')->default(1);
            // $table->uuid('liasons')->unique()->nullable();
            $table->timestamps();
            // $table->foreign('invited_by')->references('vips_uid')->on('vips')
            // ->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('liasons')->references('liasons')->on('liason_uid')
            // ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegations');
    }
};
