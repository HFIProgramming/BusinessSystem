<?php

namespace App\Listeners;

use App\Events\NewTransaction;
use App\Events\RedeemLoan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class doRedeem
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
     * @param  RedeemLoan  $event
     * @return void
     */
    public function handle(RedeemLoan $event)
    {
        //
        $loan = $event->loan;
        $loan->status = 'redeemed';
        $loan->save();

        $seller = $loan->debtor;
        $sellerItem = $seller->resources()->resid(1)->first();
        $sellerAmount = round($loan->amount * $loan->interest);
        $buyer = $loan->creditor();
        $buyerItem = $buyer->resources()->resid(1)->first();
        $buyerAmount = 0;

        event(new NewTransaction($seller, $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'loan_redeem'));
    }
}
