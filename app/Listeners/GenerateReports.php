<?php

namespace App\Listeners;

use App\Events\EndOfYear;
use App\Loan;
use App\Report;
use App\User;
use App\Company;
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
     * @param  EndOfYear $event
     * @return void
     */
    public function handle(EndOfYear $event)
    {
        //
        $current = $event->current_year;
        $companies = Company::all();
        $company_users = $companies->map(function ($company) {
            return $company->user;
        });
        foreach ($company_users as $company) {
            $buildings = [];
            foreach ($company->resources as $userResource) {
                if ($userResource->resource->type == 2)//Building
                {
                    array_push($buildings, ['name' => $userResource->resource->name, 'amount' => $userResource->amount]);
                }
            }
            $unredeemed_loan = Loan::where('debtor_id', $company->id)->where('status', 'accepted')->get()->sum('amount');
            Report::create([
                'year' => $current,
                'user_id' => $company->id,
                'type' => 'company',
                'profit' => $company->company->last_year_profit,
                'components' => [],
                'buildings' => $buildings,
                'unredeemed_loan' => $unredeemed_loan
            ]);
        }
    }
}
