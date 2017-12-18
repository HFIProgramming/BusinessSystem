<?php

namespace App\Listeners;

use App\Events\Logger;
use App\Events\StockPriceChange;
use App\Events\StockTransaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateRemaining
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
     * @param  StockTransaction  $event
     * @return void
     */
    public function handle(StockTransaction $event)
    {
        //
        $user = $event->user;
        $stock = $event->stock;
        $type = $event->type;
        $amount = $event->amount;
        if($type == 'buy')
        {
            $stock->sell_remain -= $amount;
            $stock->save();
        }
        if($type == 'sell')
        {
            $stock->buy_remain -= $amount;
            $stock->save();
        }
        event(new Logger($user->id, 'Stock.'.$type, $stock->id));
        if($stock->buy_remain * $stock->sell_remain == 0)//Time to Update Prices!!
        {
            event(new StockPriceChange($stock));
        }
    }
}
