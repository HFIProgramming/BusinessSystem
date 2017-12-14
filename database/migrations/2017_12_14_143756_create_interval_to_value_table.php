<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntervalsToValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervals_to_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lower');//close
            $table->integer('upper');//open
            //This is interval is [lower,upper)
            $table->string('value');
            $table->string('flag');//Used to discern between different functions
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
        Schema::dropIfExists('intervals_to_value');
    }
}
