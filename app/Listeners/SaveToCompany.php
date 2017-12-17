<?php

namespace App\Listeners;

use App\Company;
use App\Config;
use App\Events\EndOfYear;
use App\IntToVal;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use function Sodium\compare;

class SaveToCompany
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
            foreach($company->user->resources as $userResource)
            {
                if($userResource->resource->type == 2)
                {
                    $factors = ['powerIndex', 'happinessIndex'];
                    foreach($userResource->zones as $zone_id => $quantity)
                    {
                        $zone = Zone::find($zone_id);
                        $coeff = 1;
                        foreach ($factors as $factor)
                        {
                            $coeff *= IntToVal::IntervalValue($factor.'_'.$userResource->resource->code, $zone->$factor())->value;
                        }
                        $coeff *= Config::KeyValue('crisis_'.$userResource->resource->code)->value;
                        foreach ($userResource->resource->equivalent_to as $resource_id => $amount)
                        {
                            if($resource_id != 1)//Money is dealt with separately @TODO EXCLUDE Pollution Index
                            {
                                //@TODO Maybe Stats
                                $incomeUserResource = $company->user->resources()->resid($resource_id)->first();
                                $increment = $amount * $quantity * $coeff;
                                $incomeUserResource->amount += $increment;
                                $incomeUserResource->save();
                            }
                        }
                    }
                }
            }
            $money = $company->user->resources()->resid(1)->first();
            $money->amount += $company->last_year_profit * (1 - $company->stock->dividend);
            $money->save();
        }
    }
}
