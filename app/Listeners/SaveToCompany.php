<?php

namespace App\Listeners;

use App\Company;
use App\Config;
use App\Events\EndOfYear;
use App\Events\NewTransaction;
use App\IntToVal;
use App\Resources;
use App\User;
use Illuminate\Http\Resources\Json\Resource;
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
            $gains = [];
            $gains[1] = $company->last_year_profit * (1 - $company->stock->dividend);//$$$$$$$$
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
                            if($resource_id != 1 && Resources::find($resource_id)->type != 6)//Money is dealt with separately
                            {
                                if(!array_key_exists($resource_id, $gains))
                                {
                                    $gains[$resource_id] = 0;
                                }
                                $gains[$resource_id] += $amount * $quantity * $coeff;
                            }
                        }
                    }
                }
            }
            foreach($gains as $resource_id => $amount)
            {
                $seller = User::type(0)->first();
                $sellerItem = $seller->resources()->resid($resource_id)->first();
                $sellerAmount = round($amount);
                $buyer = $company->user;
                $buyerItem = $buyer->resources()->resid(1)->first();
                $buyerAmount = 0;
                event(new NewTransaction($seller, $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'yearly_yield'));
            }
        }
    }
}
