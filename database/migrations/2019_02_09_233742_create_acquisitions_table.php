<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcquisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('year');
            $table->text('resource_id');// The item to be sold
            $table->bigInteger('price');
            $table->bigInteger('amount');
            $table->string('status');// submitted, unsuccessful, partially successful ([amount sold]), successful
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
        Schema::dropIfExists('acquisitions');
    }
}
