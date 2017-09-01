<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'App\Events\Transaction' => [
			'App\Listeners\doTransaction',
		],

		'App\Events\NewTransaction' => [
			'App\Listeners\CreateTransaction',
		],

		'App\Events\BuyStuff' => [
			'App\Listeners\doTopUp',
		],

		'App\Events\Logger' => [
			'App\Listeners\makeLog',
		],

	];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();

		//
	}
}
