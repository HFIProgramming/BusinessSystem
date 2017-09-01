<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserResourcesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	protected $fillable = ['resource_id', 'user_id', 'amount'];

	public function up()
	{
		Schema::create('user_resources', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('resource_id');
			$table->integer('user_id');
			$table->bigInteger('amount')->default(0);
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
		Schema::dropIfExists('user_resources');
	}
}
