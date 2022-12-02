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
        Schema::create('full_weather', function (Blueprint $table) {
            $table->increments('id');
            $table->float('lat');
            $table->float('lon');
            $table->dateTime('dt');
            $table->text('city');
            $table->text('country');
            $table->text('weather');
            $table->float('temp');
            $table->integer('pressure');
            $table->integer('humidity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('full_weather');
    }
};
