<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_terrain', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('planet_id');
            $table->bigInteger('terrain_id');
            $table->timestamps();
            $table->unique(['planet_id', 'terrain_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planet_terrain');
    }
};
