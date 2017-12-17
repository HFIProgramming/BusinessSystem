<?php

namespace App\Listeners;

use App\Events\EndOfYear;
use App\Events\NewTransaction;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use function Psy\sh;

class DistributeDividends
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
        foreach(User::where('type', 2)->get() as $bank)
        {
            $sum = 0;
            foreach($bank->resources as $userResource)
            {
                if($userResource->resource->type == 3) //Stock
                {
                    $stock = $userResource->resource->stock;
                    $total = $stock->company->last_year_profit * $stock->dividend;
                    $ratio = $userResource->amount / $stock->total;
                    $share = $total * $ratio;
                    $sum += $share;
                }
            }
            $seller = User::type(0)->first();
            $sellerItem = $seller->resources()->resid(1)->first();
            $sellerAmount = round($sum);
            $buyer = $bank;
            $buyerItem = $buyer->resources()->resid(1)->first();
            $buyerAmount = 0;
            event(new NewTransaction($seller, $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'stock_dividend'));
        }
    }
}
