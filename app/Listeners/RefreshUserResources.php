<?php

namespace App\Listeners;

use App\Events\NewResource;
use App\Resources;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshUserResources
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
     * @param  NewResource  $event
     * @return void
     */
    public function handle(NewResource $event)
    {
        //
        foreach (User::all() as $user) {
            foreach (Resources::all() as $resource) {
                if (empty($user->resources()->resid($resource->id)->first())) {
                    $user->resources()->create([
                        'resource_id' => $resource->id,
                        'user_id' => $user->id,
                        'amount' => 0,
                    ]);
                }
            }
        }
    }
}
