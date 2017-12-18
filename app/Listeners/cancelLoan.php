<?php

namespace App\Listeners;

use App\Events\DeclineLoan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class cancelLoan
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
     * @param  DeclineLoan  $event
     * @return void
     */
    public function handle(DeclineLoan $event)
    {
        //
        $loan = $event->loan;
        $loan->status = 'declined';
        $loan->save();
    }
}
