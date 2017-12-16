<?php

namespace App\Listeners;

use App\Events\AcceptLoan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class doLoan
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
     * @param  AcceptLoan  $event
     * @return void
     */
    public function handle(AcceptLoan $event)
    {
        //
    }
}
