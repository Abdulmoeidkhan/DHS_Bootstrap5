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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('role')->nullable();
            $table->string('type_id')->nullable();
            $table->string('interested')->nullable();
            $table->integer('activation_code')->nullable();
            $table->integer('activated')->default(0);
            $table->integer('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
