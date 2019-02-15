<?php

namespace App\Listeners;

use App\Events\EndOfYear;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Company;
use App\Zone;
use App\Events\NewTransaction;

class CollectTax
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
            $property = $company->user->resources()->resid(1)->first()->amount;
            $company_zone = Zone::find($company->user->type);
            $tax = round($property * $company_zone->tax);
            $seller = $company->user;
            $sellerItem = $seller->resources()->resid(1)->first();
            $sellerAmount = $tax;
            $buyer = $company_zone->user;
            $buyerItem = $buyer->resources()->resid(1)->first();//would be better if we have 税务单 but nvm
            $buyerAmount = 0;
            event(new NewTransaction($buyer, $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'tax_collect'));
        }
    }
}
