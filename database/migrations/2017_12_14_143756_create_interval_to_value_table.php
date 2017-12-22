<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntervalToValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interval_to_value', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('lower');//close
            $table->bigInteger('upper');//open
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
        Schema::dropIfExists('interval_to_value');
    }
}
