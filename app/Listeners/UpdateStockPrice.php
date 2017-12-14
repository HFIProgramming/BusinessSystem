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
    }
}
