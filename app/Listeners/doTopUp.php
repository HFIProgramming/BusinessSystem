<?php

namespace App\Listeners;

use App\Events\BuyStuff;
use App\Events\incomeTransaction;
use App\Events\Logger;
use App\UserResource;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class doTopUp
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
	 * @param  BuyStuff $event
	 * @return void
	 */
	public function handle(BuyStuff $event)
	{
		// First, check requirements
		$userResources = $event->user->resources();
		$requirement = ($event->item->requirement)[$event->user->techLevel($event->item->required_tech)];

		DB::beginTransaction();
		if (!empty($requirement)) {
			foreach ($requirement as $key => $value) {
				$currentItem = $userResources->where('resource_id', $key)->first();
				$currentItem->amount = $currentItem->amount - $value * $event->amount;
				$currentItem->save();
			}
		}
		$newItem = UserResource::query()->where('resource_id', $event->item->id)->firstOrCreate([
			'user_id'     => $event->user->id,
			'resource_id' => $event->item->id,
		]);

		$newItem->amount += $event->amount * $event->item->pack;
		$newItem->save();
		DB::commit();
		event(new Logger($event->user->id, 'User.TopUp', "Item :{$event->item->id}; Amount: {$event->amount}"));
	}
}
