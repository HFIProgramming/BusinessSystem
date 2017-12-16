<?php

namespace App\Listeners;

use App\Events\NewLoan;
use App\Events\NewTransaction;
use App\Loan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Transaction;

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
        $seller = $event->creditor;
        $sellerAmount = $event->amount;
        $sellerItem = $seller->resources()->resid(1)->first();
        $buyer = $event->debtor;
        $buyerAmount = 0;
        $buyerItem = $buyer->resources()->resid(1)->first();

        $trans = new Transaction();
        $trans->seller_id = $seller->id;
        $trans->starter_id = $seller->id;
        $trans->buyer_id = $buyer->id;
        $trans->seller_resource_id = $sellerItem->id;
        $trans->buyer_resource_id = $buyerItem->id;
        $trans->seller_amount = $sellerAmount;
        $trans->buyer_amount = $buyerAmount;
        $trans->type = 'loan_grant';
        $trans->save();

        Loan::create([
            'debtor_id' => $buyer->id,
            'creditor_id' => $seller->id,
            'amount' => $event->amount,
            'interest' => $event->interest,
            'loan_transaction_id' => $trans->id,
            'status' => 'pending'
        ]);
    }
}
