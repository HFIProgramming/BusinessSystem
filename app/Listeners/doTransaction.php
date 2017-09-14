<?php

namespace App\Listeners;

use App\Events\incomeTransaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\Events\Logger;

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


		// 操作
		DB::beginTransaction();
		$sellerOutRes = $event->seller->resources()->resid($event->sellerItem)->first();
		$buyerOutRes = $event->buyer->resources()->resid($event->buyerItem)->first();
		$sellerOutRes->amount -= $event->sellerAmount;
		$buyerOutRes->amount -= $event->buyerAmount;
		$sellerOutRes->save();
		$buyerOutRes->save();
		DB::commit();

		DB::beginTransaction();
		$sellerInRes = $event->seller->resources()->resid($event->buyerItem)->first();
		$buyerInRes = $event->buyer->resources()->resid($event->sellerItem)->first();
		$sellerInRes->amount += $event->buyerAmount;
		$buyerInRes->amount += $event->sellerAmount;
		$sellerInRes->save();
		$buyerInRes->save();
		DB::commit();

		event(new Logger($event->seller->id, 'Trans.Accepted', "Seller Item :{$event->sellerItem}; Amount: {$event->sellerAmount}
		<=> Buyer Item: {$event->buyerItem}; Amount: {$event->buyerAmount}; \r\n Opposite: {$event->buyer->id}|{$event->buyer->name}"));
	}
}
