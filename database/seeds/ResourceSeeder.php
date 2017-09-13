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
        Resources::create([
            'code' => 'tech0',
            'name' => '基础技术',
            'description' => '基础技术',
            'type' => 5,
            'tech_type' => 0,
            'tech_level' => 1,
            'tech_price' => 0
        ]);
        //零件合成科技树
        // id = 6, 7, 8, 9
        $prices = [0, 60, 150, 300];
        for ($i = 0; $i <= 3; $i++) {
            Resources::create([
                'code' => 'tech1',
                'name' => '合成技术',
                'description' => '合成技术',
                'type' => 5,
                'tech_type' => 1,
                'tech_level' => $i + 1,
                'tech_price' => $prices[$i]
            ]);
        }

        //战争机器人
        // id = 10, 11, 12, 13
        //头
        Resources::create([
            'code' => 'war head',
            'name' => '战争头部',
            'description' => '战争头部（零件）',
            'type' => 2,
            'required_tech' => 1,
            'requirement' => [
                1 => [2 => 40, 3 => 20],
                2 => [2 => 40 * 0.9, 3 => 20 * 0.9],
                3 => [2 => 40 * 0.8, 3 => 20 * 0.8],
                4 => [2 => 40 * 0.7, 3 => 20 * 0.7]
            ]
        ]);
        //躯干
        Resources::create([
            'code' => 'war body',
            'name' => '战争躯干',
            'description' => '战争躯干（零件）',
            'type' => 2,
            'required_tech' => 1,
            'requirement' => [
                1 => [2 => 60, 3 => 40],
                2 => [2 => 60 * 0.9, 3 => 40 * 0.9],
                3 => [2 => 60 * 0.8, 3 => 40 * 0.8],
                4 => [2 => 60 * 0.7, 3 => 40 * 0.7]
            ]
        ]);
        //四肢
        Resources::create([
            'code' => 'war limb',
            'name' => '战争四肢',
            'description' => '战争四肢（零件）',
            'type' => 2,
            'required_tech' => 1,
            'requirement' => [
                1 => [2 => 50, 3 => 30],
                2 => [2 => 50 * 0.9, 3 => 30 * 0.9],
                3 => [2 => 50 * 0.8, 3 => 30 * 0.8],
                4 => [2 => 50 * 0.7, 3 => 30 * 0.7]
            ]
        ]);
        //整机
        Resources::create([
            'code' => 'war bot',
            'name' => '战争机器人',
            'description' => '战争机器人',
            'type' => 3,
            'required_tech' => 0,
            'requirement' => [
                1 => [10 => 1, 11 => 1, 12 => 1]
            ]
        ]);
        //工程机器人
        // id = 14, 15, 16, 17
        //头
        Resources::create([
            'code' => 'engineer head',
            'name' => '工程头部',
            'description' => '工程头部（零件）',
            'type' => 2,
            'required_tech' => 1,
            'requirement' => [
                1 => [3 => 40, 4 => 20],
                2 => [3 => 40 * 0.9, 4 => 20 * 0.9],
                3 => [3 => 40 * 0.8, 4 => 20 * 0.8],
                4 => [3 => 40 * 0.7, 4 => 20 * 0.7]
            ]
        ]);
        //躯干
        Resources::create([
            'code' => 'engineer body for engineering drawing',
            'name' => '工程躯干',
            'description' => '工程躯干（零件）',
            'type' => 2,
            'required_tech' => 1,
            'requirement' => [
                1 => [3 => 60, 4 => 40],
                2 => [3 => 60 * 0.9, 4 => 40 * 0.9],
                3 => [3 => 60 * 0.8, 4 => 40 * 0.8],
                4 => [3 => 60 * 0.7, 4 => 40 * 0.7]
            ]
        ]);
        //四肢
        Resources::create([
            'code' => 'engineer limbs',
            'name' => '工程四肢',
            'description' => '工程四肢（零件）',
            'type' => 2,
            'required_tech' => 1,
            'requirement' => [
                1 => [3 => 50, 4 => 30],
                2 => [3 => 50 * 0.9, 4 => 30 * 0.9],
                3 => [3 => 50 * 0.8, 4 => 30 * 0.8],
                4 => [3 => 50 * 0.7, 4 => 30 * 0.7]
            ]
        ]);
        //整机
        Resources::create([
            'code' => 'engineer bot',
            'name' => '工程机器人',
            'description' => '工程机器人',
            'type' => 3,
            'required_tech' => 0,
            'requirement' => [
                1 => [14 => 1, 15 => 1, 16 => 1]
            ]
        ]);
        //医疗机器人
        // id = 18, 19, 20, 21
        //头
        Resources::create([
            'code' => 'medicine head',
            'name' => '医疗头部',
            'description' => '医疗头部（零件）',
            'type' => 2,
            'required_tech' => 1,
            'requirement' => [
                1 => [4 => 40, 2 => 20],
                2 => [4 => 40 * 0.9, 2 => 20 * 0.9],
                3 => [4 => 40 * 0.8, 2 => 20 * 0.8],
                4 => [4 => 40 * 0.7, 2 => 20 * 0.7]
            ]
        ]);
        //躯干
        Resources::create([
            'code' => 'medicine body',
            'name' => '医疗躯干',
            'description' => '医疗躯干（零件）',
            'type' => 2,
            'required_tech' => 1,
            'requirement' => [
                1 => [4 => 60, 2 => 40],
                2 => [4 => 60 * 0.9, 2 => 40 * 0.9],
                3 => [4 => 60 * 0.8, 2 => 40 * 0.8],
                4 => [4 => 60 * 0.7, 2 => 40 * 0.7]
            ]
        ]);
        //四肢
        Resources::create([
            'code' => 'medicine limbs',
            'name' => '医疗四肢',
            'description' => '医疗四肢（零件）',
            'type' => 2,
            'required_tech' => 1,
            'requirement' => [
                1 => [4 => 50, 2 => 30],
                2 => [4 => 50 * 0.9, 2 => 30 * 0.9],
                3 => [4 => 50 * 0.8, 2 => 30 * 0.8],
                4 => [4 => 50 * 0.7, 2 => 30 * 0.7]
            ]
        ]);
        //整机
        Resources::create([
            'code' => 'medicine bot',
            'name' => '医疗机器人',
            'description' => '医疗机器人',
            'type' => 3,
            'required_tech' => 0,
            'requirement' => [
                1 => [18 => 1, 19 => 1, 20 => 1]
            ]
        ]);

        //矿工队A
        for($i=1;$i<=4;$i++) {
            Resources::create([
                'code' => 'mineA lv'.$i,
                'name' => '采矿A - Lv.'.$i,
                'description' => "采矿A - 科技树{$i}级",
                'type' => 4,
                'equivalent_to' => [2 => 800*(1+($i-1)/10), 3 => 400*(1+($i-1)/10), 4 => 600*(1+($i-1)/10)]
            ]);
        }
        //矿工队B
        for($i=1;$i<=4;$i++) {
            Resources::create([
                'code' => 'mineB lv'.$i,
                'name' => '采矿B - Lv.'.$i,
                'description' => "采矿B - 科技树{$i}级",
                'type' => 4,
                'equivalent_to' => [2 => 600*(1+($i-1)/10), 3 => 800*(1+($i-1)/10), 4 => 400*(1+($i-1)/10)]
            ]);
        }
        //矿工队C
        for($i=1;$i<=4;$i++) {
            Resources::create([
                'code' => 'mineC lv'.$i,
                'name' => '采矿C - Lv.'.$i,
                'description' => "采矿C - 科技树{$i}级",
                'type' => 4,
                'equivalent_to' => [2 => 400*(1+($i-1)/10), 3 => 600*(1+($i-1)/10), 4 => 800*(1+($i-1)/10)]
            ]);
        }
    }
}
