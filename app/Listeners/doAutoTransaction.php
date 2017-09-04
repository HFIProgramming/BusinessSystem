<?php

namespace App\Listeners;

use App\Events\AutoTransaction;
use App\Events\incomeTransaction;
use App\Events\NewTransaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class doAutoTransaction
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
	 * @param  AutoTransaction $event
	 * @return void
	 */
	public function handle(AutoTransaction $event)
	{
		//
		$trans = $event->trans;
		event(new incomeTransaction($trans));
		if ($trans->type == 'buy') {
			$equivalence = $trans->equivalent_to;
			foreach ($equivalence as $resource_id => $quantity) {
				$newTrans = $trans;
				$newTrans->seller_resource_id = $resource_id;
				$newTrans->seller_amount = $quantity;
				$newTrans->buyer_amount = 0;
				$newTrans->type = 'special';
				event(new NewTransaction($newTrans->seller, $newTrans->buyer, $newTrans->sellerItem, $newTrans->buyerItem, $newTrans->seller_amount, $newTrans->buyer_amount, $newTrans->type));
			}
		}
	}
}
