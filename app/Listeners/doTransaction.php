<?php

namespace App\Listeners;

use App\Events\incomeTransaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class doTransaction
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
	 * @param  incomeTransaction $event
	 * @return void
	 */
	public function handle(incomeTransaction $event)
	{

		// 找齐
		$sellerOutRes = $event->seller->resources()->where('resource_id', $event->sellerItem->id)->first();
		$sellerInRes = $event->seller->resources()->where('resource_id', $event->buyerItem->id)->first();
		$buyerOutRes = $event->buyer->resources()->where('resource_id', $event->sellerItem->id)->first();
		$buyerInRes = $event->buyer->resources()->where('resource_id', $event->buyerItem->id)->first();

		DB::beginTransaction();
		// 操作
		$sellerOutRes->amount -= $event->sellerAmount;
		$sellerInRes->amount += $event->buyerAmount;
		$buyerOutRes->amount -= $event->sellerItem;
		$buyerInRes->amount += $event->sellerAmount;

		$sellerOutRes->save();
		$sellerInRes->save();
		$buyerOutRes->save();
		$buyerInRes->save();

		DB::commit();

		event(new Logger($event->user->id, 'Trans.Accepted', "Seller Item :{$event->sellerItem->id}; Amount: {$event->sellerAmount}
		<=> Buyer Item: {$event->buyerItem->id}; Amount: {$event->buyerAmount}"));
	}
}
