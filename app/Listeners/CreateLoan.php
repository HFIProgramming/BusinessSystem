<?php

namespace App\Listeners;

use App\Events\NewLoan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateLoan
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
     * @param  NewLoan  $event
     * @return void
     */
    public function handle(NewLoan $event)
    {
        //
    }
}
