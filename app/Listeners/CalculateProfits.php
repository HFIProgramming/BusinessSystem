<?php

namespace App\Listeners;

use App\Company;
use App\Events\EndOfYear;
use App\IntToVal;
use App\Zone;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CalculateProfits
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EndOfYear  $event
     * @return void
     */
    public function handle(EndOfYear $event)
    {
        //
        foreach(Company::all() as $company)
        {
            $sum = 0;
            foreach($company->user->resources as $userResource)
            {
                if($userResource->resource->type == 2 && array_key_exists(1, $userResource->equivalent_to)) //A building that generates money
                {
                    $rawProfit = $userResource->equivalent_to[1];
                    $factors = ['powerIndex', 'happinessIndex'];
                    foreach($userResource->zones as $zone_id => $quantity)
                    {
                        $zoneProfit = $rawProfit * $quantity;
                        $zone = Zone::find($zone_id);
                        foreach($factors as $factor)
                        {
                            $coeff = IntToVal::IntervalValue($factor.'_'.$userResource->resource->code, $zone->$factor())->value;
                            $zoneProfit *= $coeff;
                        }
                        $sum += $zoneProfit;
                    }
                }
            }

            $tax = IntToVal::IntervalValue('pollution_tax', $company->pollutionIndex());

            $company->last_year_profit = $sum * (1 - $tax);
            $company->save();
        }
    }
}
