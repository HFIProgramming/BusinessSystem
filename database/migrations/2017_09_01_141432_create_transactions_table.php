<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id');
            $table->integer('buyer_id');
            $table->integer('seller_item_id');
            $table->integer('buyer_item_id');
            $table->double('seller_amount');
            $table->double('buyer_amount');
            $table->integer('checked')->default(0); // 0 Waiting, 1 Success, -1 Declined by Buyer, -2 Declined by Seller
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
        Schema::dropIfExists('transactions');
    }
}
