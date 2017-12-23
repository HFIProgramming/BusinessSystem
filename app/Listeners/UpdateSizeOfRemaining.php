<?php

namespace App\Listeners;

use App\Events\StockEvaluationChange;
use App\IntToVal;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateSizeOfRemaining
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
     * @param  StockEvaluationChange  $event
     * @return void
     */
    public function handle(StockEvaluationChange $event)
    {
        //
        $stock = $event->stock;
        $risk = $stock->riskIndex();
        $stock->sell_remain = $stock->availableInMarket() * IntToVal::IntervalValue('sell_update', $risk)->value;
        $stock->buy_remain = $stock->availableInMarket() * IntToVal::IntervalValue('buy_update', $risk)->value;
        $stock->save();
    }
}
