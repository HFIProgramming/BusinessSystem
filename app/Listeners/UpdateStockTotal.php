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
        //This is actually a listener with wrong name, as this listener can only set the total
        $stock = $event->stock;
        $root = User::type(0)->first();
        $stockResource = $root->resources()->resid($stock->resource->id)->first();
        $stockResource->amount = $event->total;
        $stockResource->save();
    }
}
