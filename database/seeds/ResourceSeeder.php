<?php

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

class ResourceSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//
		$default = [
			'code'        => 'money',
			'name'        => 'money',
			'description' => 'This is money !',
			'type'        => 0,
		];

		\App\Resources::query()->create($default);

		$faker = Faker\Factory::create();

		for ($i = 1; $i <= 3; $i++) {
			\App\Resources::query()->create([
				'code'        => str_random(5),
				'name'        => $faker->name(),
				'description' => $faker->words,
				'type'        => $faker->numberBetween(0,3),
			]);
		}
	}
}
