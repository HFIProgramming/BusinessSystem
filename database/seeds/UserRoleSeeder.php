<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//

		$default1 = [
			'user_type'             => 1,
			'resource_type'         => [0, 1],
			'user_transaction_type' => [0, 1, 2],
		];

		$default2 = [
			'user_type'             => 2,
			'resource_type'         => [0, 2, 3],
			'user_transaction_type' => [0, 1, 2],
		];

		\App\UserTransactionRule::query()->create($default1);
		\App\UserTransactionRule::query()->create($default2);
	}
}
