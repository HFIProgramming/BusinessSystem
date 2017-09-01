<?php

namespace App\Listeners;

use App\Events\AutoTransaction;
use App\Events\incomeTransaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class doAutoTransaction
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
     * @param  AutoTransaction  $event
     * @return void
     */
    public function handle(AutoTransaction $event)
    {
        //
        $trans = $event->trans;
        event(new incomeTransaction($trans));
    }
}
