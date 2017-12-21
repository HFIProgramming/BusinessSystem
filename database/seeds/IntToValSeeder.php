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
            'lower' => -1000000,
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
            'upper' => 1000000,
            'flag' => 'powerIndex_PowerStation',
            'value' => 0.8
        ]);

        IntToVal::create([
            'lower' => -1000000,
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
            'upper' => 1000000,
            'flag' => 'powerIndex_Disney',
            'value' => 1.2
        ]);

        IntToVal::create([
            'lower' => -1000000,
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
            'upper' => 1000000,
            'flag' => 'powerIndex_Mining',
            'value' => 1.2
        ]);

        $arr = [[1.3, 200, 1000000], [1.2, 100, 200], [1.1, 50, 100], [1, -50, 50], [0.9, -100, -50], [0.8, -200, -100], [0.7, -1000000, -200]];
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
            'lower' => -1000000,
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
            'upper' => 1000000,
            'flag' => 'pollution_tax',
            'value' => 0.5
        ]);

        $arr = [[0.1125, 0, 30], [0.025, 30, 60], [0.0125, 60, 100], [0.002, 100, 1000000]];
        foreach ($arr as $data)
        {
            IntToVal::create([
                'lower' => $data[1],
                'upper' => $data[2],
                'flag' => 'buy_remain',
                'value' => $data[0]
            ]);
        }
        $arr = [[0.0125, 0, 30], [0.025, 30, 60], [0.1125, 60, 100], [0.18, 100, 1000000]];
        foreach ($arr as $data)
        {
            IntToVal::create([
                'lower' => $data[1],
                'upper' => $data[2],
                'flag' => 'sell_remain',
                'value' => $data[0]
            ]);
        }
    }
}
