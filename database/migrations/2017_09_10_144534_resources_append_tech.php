<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResourcesAppendTech extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('resources', function(Blueprint $table) {
            $table->integer('required_tech');
            $table->integer('tech_type');
            // 0=basic tech 1=top up tech
            $table->integer('tech_level');
            $table->integer('tech_price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
