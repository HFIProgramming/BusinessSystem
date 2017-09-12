<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//
		$config = [
			'is_able_to_register' => 1,
			'startup_fund_1'        => 100,
            'startup_fund_2'        => 200,//specific?
			'primary_color'       => 'yellow',
			'accent_color'        => 'red',
			'current_round'       => 0,
			'total_round'         => 20,
			'is_continued'        => 1,
		];
		foreach ($config as $key => $value) {
			\App\Config::query()->create([
				'key' => $key, 'value' => $value,
			]);
		}
	}
}
