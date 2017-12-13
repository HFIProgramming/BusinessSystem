<?php

namespace App\Listeners;

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
    }
}
