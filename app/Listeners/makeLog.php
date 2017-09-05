<?php

namespace App\Listeners;

use App\Events\Logger;
use App\Logs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class makeLog
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
     * @param  Logger  $event
     * @return void
     */
    public function handle(Logger $event)
    {
        //
	    $log = new Logs();
	    $log->user_id = $event->user;
	    $log->function = $event->function;
	    $log->message = $event->message;
	    $log->current_round = $event->currentRound;
	    $log->save();
    }
}
