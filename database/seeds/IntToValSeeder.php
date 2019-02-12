<?php

use Illuminate\Database\Seeder;
use App\IntToVal;

class IntToValSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        IntToVal::create([
            'lower' => -10000000000000,
            'upper' => -30,
            'flag' => 'powerIndex_PowerStation',
            'value' => 1.2
        ]);
        IntToVal::create([
            'lower' => -30,
            'upper' => 30,
            'flag' => 'powerIndex_PowerStation',
            'value' => 1
        ]);
        IntToVal::create([
            'lower' => 30,
            'upper' => 10000000000000,
            'flag' => 'powerIndex_PowerStation',
            'value' => 0.8
        ]);

        IntToVal::create([
            'lower' => -10000000000000,
            'upper' => -30,
            'flag' => 'powerIndex_Disney',
            'value' => 0.8
        ]);
        IntToVal::create([
            'lower' => -30,
            'upper' => 30,
            'flag' => 'powerIndex_Disney',
            'value' => 1
        ]);
        IntToVal::create([
            'lower' => 30,
            'upper' => 10000000000000,
            'flag' => 'powerIndex_Disney',
            'value' => 1.2
        ]);

        IntToVal::create([
            'lower' => -10000000000000,
            'upper' => -30,
            'flag' => 'powerIndex_Mining',
            'value' => 0.8
        ]);
        IntToVal::create([
            'lower' => -30,
            'upper' => 30,
            'flag' => 'powerIndex_Mining',
            'value' => 1
        ]);
        IntToVal::create([
            'lower' => 30,
            'upper' => 10000000000000,
            'flag' => 'powerIndex_Mining',
            'value' => 1.2
        ]);

        $arr = [[1.3, 200, 10000000000000], [1.2, 100, 200], [1.1, 50, 100], [1, -50, 50], [0.9, -100, -50], [0.8, -200, -100], [0.7, -10000000000000, -200]];
        foreach ($arr as $data)
        {
            IntToVal::create([
                'lower' => $data[1],
                'upper' => $data[2],
                'flag' => 'happinessIndex_Disney',
                'value' => $data[0]
            ]);
            IntToVal::create([
                'lower' => $data[1],
                'upper' => $data[2],
                'flag' => 'happinessIndex_PowerStation',
                'value' => $data[0]
            ]);
            IntToVal::create([
                'lower' => $data[1],
                'upper' => $data[2],
                'flag' => 'happinessIndex_Mining',
                'value' => 1
            ]);
        }

        IntToVal::create([
            'lower' => -10000000000000,
            'upper' => 180,
            'flag' => 'pollution_tax',
            'value' => 0
        ]);
        IntToVal::create([
            'lower' => 180,
            'upper' => 250,
            'flag' => 'pollution_tax',
            'value' => 0.25
        ]);
        IntToVal::create([
            'lower' => 250,
            'upper' => 10000000000000,
            'flag' => 'pollution_tax',
            'value' => 0.5
        ]);

        //区域矿业指数
        //lower: 奇数为南方，偶数为北方
        IntToVal::create([
            'lower' => 1,
            'upper' => 2,
            'flag' => 'regionalMiningIndex_Mining',
            'value' => 3
        ]);
        IntToVal::create([
            'lower' => 2,
            'upper' => 3,
            'flag' => 'regionalMiningIndex_Mining',
            'value' => 1
        ]);
        IntToVal::create([
            'lower' => 3,
            'upper' => 4,
            'flag' => 'regionalMiningIndex_Mining',
            'value' => 3.6
        ]);
        IntToVal::create([
            'lower' => 4,
            'upper' => 5,
            'flag' => 'regionalMiningIndex_Mining',
            'value' => 1.4
        ]);
        IntToVal::create([
            'lower' => 5,
            'upper' => 2,
            'flag' => 'regionalMiningIndex_Mining',
            'value' => 4.32
        ]);
        IntToVal::create([
            'lower' => 6,
            'upper' => 3,
            'flag' => 'regionalMiningIndex_Mining',
            'value' => 4.2
        ]);

        IntToVal::create([
            'lower' => -10,
            'upper' => 10,
            'flag' => 'regionalMiningIndex_PowerStation',
            'value' => 1
        ]);
        IntToVal::create([
            'lower' => -10,
            'upper' => 10,
            'flag' => 'regionalMiningIndex_Disney',
            'value' => 1
        ]);

        IntToVal::create([
            'lower' => 2000000000,
            'upper' => 4000000001,
            'flag' => 'acceptable_bid_range',
            'value' => 1
        ]);
    }
}
