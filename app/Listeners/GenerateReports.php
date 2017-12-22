<?php

namespace App\Listeners;

use App\Events\EndOfYear;
use App\Loan;
use App\Report;
use App\User;
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
        $companyShareHolders = [];
        foreach (User::type(2)->get() as $bank) {
            $components = [];
            foreach ($bank->resources as $userResource) {
                if ($userResource->resource->type == 3)//Stock
                {
                    $share = $userResource->amount / $userResource->resource->stock->total;
                    if ($share >= 0.1) {
                        $components[$userResource->resource->stock->company->user_id] = $share;
                        $companyShareHolders[$userResource->resource->stock->company->user_id][$bank->id] = $share;
                    }
                }
            }
            $loan_total = Loan::where('creditor_id', $bank->id)->where('status', 'accepted')->get()->sum('amount');
            Report::create([
                'year' => $current,
                'user_id' => $bank->id,
                'type' => 'bank',
                'components' => $components,
                'loan_total' => $loan_total
            ]);
        }
        foreach (User::type(1)->get() as $company) {
            $components = array_key_exists($company->id, $companyShareHolders) ? $companyShareHolders[$company->id] : [];
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
                'stock_price' => $company->company->stock->current_price,
                'profit' => $company->company->last_year_profit,
                'components' => $components,
                'buildings' => $buildings,
                'dividend' => $company->company->stock->dividend,
                'unredeemed_loan' => $unredeemed_loan
            ]);
        }
    }
}
