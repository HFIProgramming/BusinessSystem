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
		'App\Events\incomeTransaction' => [
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

        'App\Events\AutoTransaction' => [
            'App\Listeners\doAutoTransaction'
        ],

        'App\Events\StockTransaction' => [
            'App\Listeners\UpdateRemaining'
        ],

        'App\Events\StockPriceChange' => [
            'App\Listeners\UpdateStockPrice'
        ],

        'App\Events\NewLoan' => [
            'App\Listeners\CreateLoan'
        ],

        'App\Events\AcceptLoan' => [
            'App\Listeners\doLoan'
        ],

        'App\Events\DeclineLoan' => [
          'App\Listeners\cancelLoan'
        ],

        'App\Events\RedeemLoan' => [
            'App\Listeners\doRedeem'
        ],

        'App\Events\EndOfYear' => [
            // 'App\Listeners\CalculateProfits',
            // 'App\Listeners\DistributeDividends',
            'App\Listeners\SaveToCompany',
            // 'App\Listeners\GenerateReports'
        ],

        'App\Events\NewResource' => [
            'App\Listeners\RefreshUserResources'
        ],

        'App\Events\StockTotalChange' => [
            'App\Listeners\UpdateStockTotal'
        ],

        'App\Events\StockEvaluationChange' => [
            'App\Listeners\UpdateSizeOfRemaining'
        ]

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
