<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            //id=1 => money
            $table->string('code');
            $table->string('name');
            $table->string('description');
            $table->string('type');
            //0=中间货币 1=原材料 2=建筑 3=成品机器人 4=兑换券 5=科技 6=指数
            $table->text('requirement')->nullable();
            $table->integer('pack')->default(1);
            $table->integer('acquisition_price')->default(0);//政府收购价
            $table->integer('employment_price')->default(0);//雇佣价
            $table->text('equivalent_to')->nullable();//used for BOTH Transactions and TopUps
            $table->text('tax')->nullable();
            //The item above lists the items that do not go to the buyer but to someone else.
            //This mechanism is similar to the process of taxing, hence the name.
            $table->integer('required_tech')->nullable();
            $table->integer('tech_type')->nullable();
            $table->integer('tech_level')->nullable();
            $table->integer('tech_price')->nullable();
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
        Schema::dropIfExists('resources');
    }
}
