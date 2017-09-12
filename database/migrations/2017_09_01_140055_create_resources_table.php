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
            //0=中间货币 1=原材料 2=半成品 3=成品 4=兑换券 5=科技
            $table->text('requirement')->nullable();
            $table->integer('pack')->default(1);
            $table->integer('acquisition_price')->default(0);//政府收购价
            $table->integer('employment_price')->default(0);//雇佣价
            $table->text('equivalent_to')->nullable();
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
