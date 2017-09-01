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
		$sellerOutRes = $event->seller->resources()->id($event->sellerItem->id);
		$sellerInRes = $event->seller->resources()->id($event->buyerItem->id);
		$buyerOutRes = $event->buyer->resources()->id($event->sellerItem->id);
		$buyerInRes = $event->buyer->resources()->id($event->buyerItem->id);

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
