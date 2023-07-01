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
            $table->string('name');
            $table->integer('nik')->unique();
            $table->string('image');
            $table->boolean('is_active')->default(false);
            $table->boolean('role')->default(false);
            $table->string('password');
            $table->string('status_login')->default('offline');
            $table->timestamp('is_login')->nullable();
            $table->string('user_time_login')->nullable();
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
