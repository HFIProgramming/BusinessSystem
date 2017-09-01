<?php

namespace App\Listeners;

use App\Events\NewTransaction;
use App\Transaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTransaction
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
     * @param  NewTransaction  $event
     * @return void
     */
    public function handle(NewTransaction $event)
    {
        //
	    $trans = new Transaction();
	    $trans->seller_id = $event->seller->id;
	    $trans->buyer_id = $event->buyer->id;
	    $trans->seller_item_id = $event->sellerItem->id;
	    $trans->buyer_item_id = $event->buyerItem->id;
	    $trans->seller_amount = $event->sellerAmount;
	    $trans->buyer_amount = $event->buyerAmount;
	    $trans->save();
    }
}
