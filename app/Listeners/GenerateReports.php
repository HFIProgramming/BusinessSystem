<?php

namespace App\Listeners;

use App\Events\EndOfYear;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateReports
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
     * @param  EndOfYear  $event
     * @return void
     */
    public function handle(EndOfYear $event)
    {
        //
        $current = $event->current_year;
        foreach(User::all() as $user)
        {
            if($user->type == 1 || $user->type == 2)
            {

            }
        }
    }
}
