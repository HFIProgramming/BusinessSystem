<?php

namespace App\Listeners;

use App\Events\AcceptLoan;
use App\Events\incomeTransaction;
use App\Transaction;
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
        $loan = $event->loan;
        $loan->status = 'accepted';
        $loan->save();
        event(new incomeTransaction($loan->loanTransaction));
    }
}
