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
            $table->integer('starter_id');
            $table->integer('seller_id');
            $table->integer('buyer_id');
            $table->integer('seller_resource_id');
            $table->integer('buyer_resource_id');
            $table->double('seller_amount');
            $table->double('buyer_amount');
            $table->string('type');//buy=买方发起 sell=卖方发起 special=equivalence中间交易 loan_grant, loan_redeem 贷款相关
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
