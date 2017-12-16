<?php

namespace App\Listeners;

use App\Events\RedeemLoan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class doRedeem
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
     * @param  RedeemLoan  $event
     * @return void
     */
    public function handle(RedeemLoan $event)
    {
        //
    }
}
