<?php

namespace App\Listeners;

use App\Events\AutoTransaction;
use App\Events\incomeTransaction;
use App\Events\NewTransaction;
use App\UserResource;
use App\User;
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
        $trans->checked = 1;
        $trans->save();
		event(new incomeTransaction($trans));
		if (!empty($trans->sellerResource->resource->equivalent_to)) {
			$equivalence = $trans->sellerResource->resource->equivalent_to;
			foreach ($equivalence as $resource_id => $quantity) {
				$newTrans = $trans;
				$newTrans->sellerResource = User::type(0)->first()->resources()->resid($resource_id)->first();
				$newTrans->seller_amount = $quantity;
				$newTrans->buyer_amount = 0;
				$newTrans->type = 'special';
				event(new NewTransaction($newTrans->starter, $newTrans->seller, $newTrans->buyer, $newTrans->sellerResource, $newTrans->buyerResource, $newTrans->seller_amount, $newTrans->buyer_amount, $newTrans->type));
			}
		}
	}
}
