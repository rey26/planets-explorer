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
        Schema::create('journal_logs', function (Blueprint $table) {
            $table->id();
            $table->string('mood')->nullable();
            $table->string('weather')->nullable();
            $table->string('lat');
            $table->string('lon');
            $table->string('encrypted_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_logs');
    }
};
