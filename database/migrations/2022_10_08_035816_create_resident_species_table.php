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
        Schema::create('resident_species', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('resident_id');
            $table->bigInteger('species_id');
            $table->timestamps();
            $table->unique(['resident_id', 'species_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resident_species');
    }
};
