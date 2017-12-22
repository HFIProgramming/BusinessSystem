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

        $arr = [[0.1125, 0, 5], [0.05, 5, 15], [0.0125, 15, 20], [0.002, 20, 10000000000000]];
        foreach ($arr as $data)
        {
            IntToVal::create([
                'lower' => $data[1],
                'upper' => $data[2],
                'flag' => 'buy_update',
                'value' => $data[0]
            ]);
        }
        $arr = [[0.0125, 0, 5], [0.05, 5, 15], [0.1125, 15, 20], [0.18, 20, 10000000000000]];
        foreach ($arr as $data)
        {
            IntToVal::create([
                'lower' => $data[1],
                'upper' => $data[2],
                'flag' => 'sell_update',
                'value' => $data[0]
            ]);
        }
        $arr = [['低风险', 0, 5], ['正常风险', 5, 15], ['高风险', 15, 20], ['极高风险', 20, 10000000000000]];
        foreach ($arr as $data)
        {
            IntToVal::create([
                'lower' => $data[1],
                'upper' => $data[2],
                'flag' => 'risk_evaluation',
                'value' => $data[0]
            ]);
        }
    }
}
