<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->integer('user_id');
            $table->string('type');//'bank', 'company'
            $table->text('components');//different for bank and company
            $table->float('stock_price')->nullable();//only for company
            $table->float('dividend')->nullable();
            $table->bigInteger('profit')->nullable();//only for company
            $table->bigInteger('loan_total')->nullable();//only for bank
            $table->bigInteger('unredeemed_loan')->nullable();//only for company
            $table->text('buildings')->nullable();//only for company
            $table->timestamps();
            //This is a migration very specific for this contest. Probably useless later.
            //Probably there are more subtle ways to do this!
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
