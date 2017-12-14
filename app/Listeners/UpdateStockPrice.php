<?php

namespace App\Listeners;

use App\Events\StockPriceChange;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateStockPrice
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
     * @param  StockPriceChange  $event
     * @return void
     */
    public function handle(StockPriceChange $event)
    {
        //
        $stock = $event->stock;
        //Need to update: current$, history$, sell_remain, buy_remain
        array_push($stock->history_prices, $stock->current_price);
        if($stock->buy_remain == 0) //Go down!
        {
            $stock->current_price = $stock->buyPrice();
        }
        else if($stock->sell_remain == 0) //Go up!
        {
            $stock->current_price = $stock->sellPrice();
        }
        $stock->save();
    }
}
