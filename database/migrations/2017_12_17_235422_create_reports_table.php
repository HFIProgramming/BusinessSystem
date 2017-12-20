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
            $table->integer('profit')->nullable();//only for company
            $table->integer('loan_total')->nullable();//only for bank
            $table->timestamps();
            //This is a migration very specific for this contest. Probably useless later.
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
