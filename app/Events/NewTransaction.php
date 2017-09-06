<?php

namespace App\Events;

use App\Resources;
use App\User;
use App\UserResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewTransaction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $starter;
    public $seller;
    public $buyer;
    public $sellerItem;
    public $buyerItem;
    public $sellerAmount;
    public $buyerAmount;
    public $type;

    /**
     * Create a new event instance.
     *
     * @param User $starter
     * @param User $seller
     * @param User $buyer
     * @param UserResource $sellerItem
     * @param UserResource $buyerItem
     * @param $sellerAmount
     * @param $buyerAmount
     * @param $type
     */
    public function __construct(User $starter, User $seller, User $buyer, UserResource $sellerItem, UserResource $buyerItem, $sellerAmount, $buyerAmount, $type)
    {
        //
	    $this->starter = $starter;
	    $this->seller = $seller;
	    $this->buyer = $buyer;
	    $this->sellerItem = $sellerItem;
	    $this->buyerItem = $buyerItem;
	    $this->sellerAmount = $sellerAmount;
	    $this->buyerAmount = $buyerAmount;
	    $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
