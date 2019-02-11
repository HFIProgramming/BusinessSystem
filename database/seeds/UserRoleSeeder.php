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
			'user_type'             => 1, //南方
			'resource_type'         => [0, 1, 2, 3, 4, 7],
			'user_transaction_type' => [1, 2],
		];

		$default2 = [
			'user_type'             => 2, //北方
			'resource_type'         => [0, 1, 2, 3, 4, 7],
			'user_transaction_type' => [1, 2],
		];

        $default3 = [
            'user_type'             => 0, //管理员
            'resource_type'         => [0, 1, 2, 3, 4, 5, 6],
            'user_transaction_type' => [0, 1, 2, 3],
        ];


		\App\UserTransactionRule::query()->create($default1);
		\App\UserTransactionRule::query()->create($default2);
        \App\UserTransactionRule::query()->create($default3);
	}
}
