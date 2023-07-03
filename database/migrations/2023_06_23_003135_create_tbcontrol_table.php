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
        Schema::create('tbcontrol', function (Blueprint $table) {
            $table->id();
            $table->integer('power');
            $table->integer('suhu');
            $table->integer('cool')->nullable();
            $table->integer('fan')->nullable();
            $table->integer('dry')->nullable();
            $table->integer('fanauto')->nullable();
            $table->integer('fanhigh')->nullable();
            $table->string('statuspower')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbcontrol');
    }
};
