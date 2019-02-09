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
			'startup_fund_1'        => 20000000000,
            'startup_fund_2'        => 20000000000,
			'primary_color'       => 'yellow',
			'accent_color'        => 'red',
			'current_round'       => 1,
			'total_round'         => 20,
			'is_continued'        => 1,
            'crisis_PowerStation' => 1,
            'crisis_Disney' => 1,
            'crisis_Mining' => 1,
            'stock_transactions_limit' => 15,
            'infinity' => 10000000000,
            'auction_activated' => 0,
            'auction_items_and_amount' => json_encode([]),
            'acquisition_activated' => 0,
            'acquisition_items_and_amount' => json_encode([])
		];
		foreach ($config as $key => $value) {
			\App\Config::query()->create([
				'key' => $key, 'value' => $value,
			]);
		}
	}
}
