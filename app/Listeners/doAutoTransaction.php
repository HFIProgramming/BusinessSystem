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
		event(new incomeTransaction($trans));
		if (!empty($trans->sellerResource->resource->equivalent_to)) {
			$equivalence = $trans->sellerResource->resource->equivalent_to;
			foreach ($equivalence as $resource_id => $quantity) {
				$newTrans = $trans;
				$newTrans->seller_resource_id = User::type(0)->first()->resources()->resid($resource_id)->first()->id;
				$newTrans->seller_amount = $quantity;
				$newTrans->buyer_amount = 0;
				$newTrans->type = 'special';
				event(new NewTransaction($newTrans->starter, $newTrans->seller, $newTrans->buyer, UserResource::find($newTrans->seller_resource_id), UserResource::find($newTrans->buyer_resource_id), $newTrans->seller_amount, $newTrans->buyer_amount, $newTrans->type));
			}
		}//@TODO check if this new condition works
        //@TODO DELIBERATE on whether to use type or equivalent_to as the condition.
	}
}
