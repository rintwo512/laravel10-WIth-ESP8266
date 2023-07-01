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
            $table->integer('cool');
            $table->integer('fan');
            $table->integer('dry');
            $table->integer('fanauto');
            $table->integer('fanhigh');
            $table->string('statuspower');
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
