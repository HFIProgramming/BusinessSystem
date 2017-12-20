<?php

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use App\Resources;

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
        $money = [
            'code' => 'money',
            'name' => 'money',
            'description' => 'This is money !',
            'type' => 0,
        ];

        Resources::query()->create($money);

//		$faker = Faker\Factory::create();
//
//		for ($i = 1; $i <= 3; $i++) {
//			\App\Resources::query()->create([
//				'code'        => str_random(5),
//				'name'        => $faker->name(),
//				'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
//				'type'        => $faker->numberBetween(0,3),
//			]);
//		}

        //一堆石头
        $stones = ['A', 'B', 'C'];//id = 2, 3, 4
        foreach ($stones as $stone) {
            Resources::create([
                'code' => '破石头' . $stone,
                'name' => '矿石' . $stone,
                'description' => '一种石头',
                'type' => 1
            ]);
        }

        //一堆技术
        //Basic Tech: 不需要科技树的合成
        //id = 5
//        Resources::create([
//            'code' => 'tech0',
//            'name' => '基础技术',
//            'description' => '基础技术',
//            'type' => 5,
//            'tech_type' => 0,
//            'tech_level' => 1,
//            'tech_price' => 0
//        ]);
//        //零件合成科技树
//        // id = 6, 7, 8, 9
//        $prices = [0, 60, 150, 300];
//        for ($i = 0; $i <= 3; $i++) {
//            Resources::create([
//                'code' => 'tech1',
//                'name' => '合成技术',
//                'description' => '合成技术',
//                'type' => 5,
//                'tech_type' => 1,
//                'tech_level' => $i + 1,
//                'tech_price' => $prices[$i]
//            ]);
//        }

        //id=5
        Resources::create([
            'code' => 'powerIndex',
            'name' => '电力指数',
            'description' => '一种指数',
            'type' => 6
        ]);

        //id=6
        Resources::create([
            'code' => 'happinessIndex',
            'name' => '幸福指数',
            'description' => '一种指数',
            'type' => 6
        ]);

        //id=7
        Resources::create([
            'code' => 'pollutionIndex',
            'name' => '污染指数',
            'description' => '一种指数',
            'type' => 6
        ]);

        //一堆技术
        //Basic Tech: 不需要科技树的合成
        //id = 8
        Resources::create([
            'code' => 'tech0',
            'name' => '基础技术',
            'description' => '基础技术',
            'type' => 5,
            'tech_type' => 0,
            'tech_level' => 1,
            'tech_price' => 0
        ]);

        //id=9
        Resources::create([
            'code' => 'PowerStation',
            'name' => '发电厂',
            'description' => '发电厂',
            'equivalent_to' => [1 => 16],
            'type' => 2
        ]);

        //id=10
        Resources::create([
            'code' => 'PowerStation_build',
            'name' => '建造发电厂',
            'description' => '建造时购买此物品',
            'type' => 4,
            'required_tech' => 0,
            'requirement' => [1 => [1 => 46, 2 => 500, 3 => 200, 4 => 100]],
            'equivalent_to' => [9 => 1, 7 => 50],
            'tax' => [5 => 100, 6 => -100]
        ]);

        //id=11
        Resources::create([
            'code' => 'Disney',
            'name' => '游乐场',
            'description' => '游乐场',
            'equivalent_to' => [1 => 16],
            'type' => 2
        ]);

        //id=12
        Resources::create([
            'code' => 'Disney_build',
            'name' => '建造游乐场',
            'description' => '建造时购买此物品',
            'type' => 4,
            'required_tech' => 0,
            'requirement' => [1 => [1 => 46, 2 => 100, 3 => 500, 4 => 200]],
            'equivalent_to' => [11 => 1, 7 => 20],
            'tax' => [5 => -40, 6 => 60]
        ]);

        //id=13
        Resources::create([
            'code' => 'Mining',
            'name' => '采矿场',
            'description' => '采矿场',
            'equivalent_to' => [2 => 300, 3 => 300, 4 => 300],
            'type' => 2
        ]);

        //id=14
        Resources::create([
            'code' => 'Mining_build',
            'name' => '建造采矿场',
            'description' => '建造时购买此物品',
            'type' => 4,
            'required_tech' => 0,
            'requirement' => [1 => [1 => 46, 2 => 300, 3 => 200, 4 => 500]],
            'equivalent_to' => [13 => 1, 7 => 10],
            'tax' => [5 => -10, 6 => -20]
        ]);

        //id=15
        Resources::create([
            'code' => 'GarbageProcess',
            'name' => '垃圾处理厂',
            'description' => '建造时购买此物品',
            'type' => 2,
            'required_tech' => 0,
            'requirement' => [1 => [1 => 35, 2 => 250, 3 => 250, 4 => 250]],
            'equivalent_to' => [7 => -150],
            'tax' => [5 => -20]
        ]);
    }
}
