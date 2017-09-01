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
	    $log->section = $event->modelName;
	    $log->message = $event->message;
	    $log->save();
    }
}
