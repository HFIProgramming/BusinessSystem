<?php

namespace App\Listeners;

use App\Company;
use App\Events\EndOfYear;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveToCompany
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
        foreach(Company::all() as $company)
        {

        }
    }
}
