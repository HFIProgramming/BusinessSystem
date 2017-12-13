<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->float('current_price');
            $table->string('history_prices');
            $table->integer('company_id');
            $table->integer('resource_id');
            $table->integer('total');
            $table->float('dividend');
            $table->string('up_poly_coeff');//the polynomial coefficients to calculate the price if go up
            $table->string('down_poly_coeff');//similar as above
            $table->integer('sell_remain');
            $table->integer('buy_remain');
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
        Schema::dropIfExists('stocks');
    }
}
