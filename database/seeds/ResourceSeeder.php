<?php

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use App\Resources;
use App\Config;

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
            'code' => 'Money',
            'name' => '金钱',
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
            'description' => '影响各行业收成',
            'type' => 6
        ]);

        //id=6
        Resources::create([
            'code' => 'happinessIndex',
            'name' => '幸福指数',
            'description' => '影响各行业收成',
            'type' => 6
        ]);

        //id=7
        Resources::create([
            'code' => 'regionalMiningIndex',
            'name' => '地区矿业指数',
            'description' => '南方矿产大于北方',
            'type' => 6
        ]);

        //智能芯片
        //id = 8
        Resources::create([
                'code' => 'chips',
                'name' => '智能芯片',
                'description' => '智能芯片',
                'type' => 1,
                'required_tech' => 0,
                'requirement' => [1 => [2 => 1, 3 => 1, 4 => 1, 15 => 1, 20 => 1]]
        ]);

        //id=9
        Resources::create([
            'code' => 'PowerStation',
            'name' => '发电厂',
            'description' => '发电厂',
            'equivalent_to' => [1 => 1600000000],
            'type' => 2
        ]);

        //id=10
        Resources::create([
            'code' => 'PowerStation_build',
            'name' => '建造发电厂',
            'description' => '建造时购买此物品',
            'type' => 4,
            'required_tech' => 0,
            'requirement' => [1 => [1 => 4600000000, 2 => 500, 3 => 200, 4 => 100, 8 => 50]],
            'equivalent_to' => [9 => 1],
            'tax' => [5 => 100, 6 => -100]
        ]);

        //id=11
        Resources::create([
            'code' => 'Disney',
            'name' => '游乐场',
            'description' => '游乐场',
            'equivalent_to' => [1 => 1600000000],
            'type' => 2
        ]);

        //id=12
        Resources::create([
            'code' => 'Disney_build',
            'name' => '建造游乐场',
            'description' => '建造时购买此物品',
            'type' => 4,
            'required_tech' => 0,
            'requirement' => [1 => [1 => 4600000000, 2 => 100, 3 => 500, 4 => 200, 8 => 50]],
            'equivalent_to' => [11 => 1],
            'tax' => [5 => -40, 6 => 60]
        ]);

        //id=13
        Resources::create([
            'code' => 'Mining',
            'name' => '采矿场',
            'description' => '采矿场',
            'equivalent_to' => [2 => 100, 3 => 100, 4 => 100],
            'type' => 2
        ]);

        //id=14
        Resources::create([
            'code' => 'Mining_build',
            'name' => '建造采矿场',
            'description' => '建造时购买此物品',
            'type' => 4,
            'required_tech' => 0,
            'requirement' => [1 => [1 => 4600000000, 2 => 300, 3 => 200, 4 => 500]],
            'equivalent_to' => [13 => 1],
            'tax' => [5 => -10, 6 => -20]
        ]);

        //id=15
        Resources::create([
            'code' => 'Factory',
            'name' => '加工厂（耗材）',
            'description' => '既是建筑本身，又是加工的耗材',
            'equivalent_to' => [],
            'type' => 7
        ]);

        //id=16
        Resources::create([
            'code' => 'Factory_build',
            'name' => '建造加工厂',
            'description' => '建造时购买此物品：实际所得无限的加工厂耗材',
            'type' => 4,
            'required_tech' => 0,
            'requirement' => [1 => [1 => 4600000000, 2 => 300, 3 => 200, 4 => 500]],
            'equivalent_to' => [15 => Config::KeyValue('infinity')->value],
            'tax' => [5 => -10, 6 => -20]
        ]);

        //各种机器人

        //id=17
        Resources::create([
                'code' => 'WarBot',
                'name' => '战争机器人',
                'description' => '西点军校研究院制造的迅猛凶残的战争机器人',
                'type' => 3,
                'required_tech' => 1,
                'requirement' => [
                    1 => [2 => 50, 3 => 20, 4 => 10, 8 => 20, 15 => 1],
                    2 => [2 => 40, 3 => 16, 4 => 8, 8 => 20, 15 => 1],
                    3 => [2 => 32, 3 => 13, 4 => 6, 8 => 20, 15 => 1]
                ]
        ]);

        //id=18
        Resources::create([
                'code' => 'MedBot',
                'name' => '医疗机器人',
                'description' => '出身哈佛医学院的大白',
                'type' => 3,
                'required_tech' => 1,
                'requirement' => [
                    1 => [2 => 10, 3 => 50, 4 => 20, 8 => 20, 15 => 1],
                    2 => [2 => 8, 3 => 40, 4 => 16, 8 => 20, 15 => 1],
                    3 => [2 => 6, 3 => 32, 4 => 13, 8 => 20, 15 => 1]
                ]
        ]);

        //id=19
        Resources::create([
                'code' => 'EngBot',
                'name' => '工程机器人',
                'description' => '牛津大学工程系一等毕业生',
                'type' => 3,
                'required_tech' => 1,
                'requirement' => [
                    1 => [2 => 20, 3 => 10, 4 => 50, 8 => 20, 15 => 1],
                    2 => [2 => 16, 3 => 8, 4 => 40, 8 => 20, 15 => 1],
                    3 => [2 => 13, 3 => 6, 4 => 32, 8 => 20, 15 => 1]
                ]
        ]);

        //芯片耗材: 北方有很多 南方没有
        //id=20
        Resources::create([
            'code' => 'ChipsMaterials',
            'name' => '芯片耗材',
            'description' => '你在南方的艳阳里砍树挖矿，我在北方的寒夜里制造芯片',
            'equivalent_to' => [],
            'type' => 7
        ]);

        //id=21
        Resources::create([
            'code' => 'MaterialsPack',
            'name' => '材料包',
            'description' => '拍卖成功时获得此项目及其所包含项目',
            'type' => 4,
            'equivalent_to' => [2 => 300, 3 => 300, 4 => 300, 8 => 50]
        ]);
    }
}
