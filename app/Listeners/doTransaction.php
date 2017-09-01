<?php

namespace App\Listeners;

use App\Events\Transaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class doTransaction
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
     * @param  Transaction  $event
     * @return void
     */
    public function handle(Transaction $event)
    {
        //
    }
}
