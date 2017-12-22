<?php

namespace App\Listeners;

use App\Events\StockTotalChange;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateStockTotal
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
     * @param  StockTotalChange  $event
     * @return void
     */
    public function handle(StockTotalChange $event)
    {
        //
    }
}
