<?php

namespace App\Events;

use App\Resources;
use App\User;
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

    public $seller;
    public $buyer;
    public $sellerItem;
    public $buyerItem;
    public $sellerAmount;
    public $buyerAmount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $seller, User $buyer, Resources $sellerItem, Resources $buyerItem, $sellerAmount, $buyerAmount)
    {
        //
	    $this->seller = $seller;
	    $this->buyer = $buyer;
	    $this->sellerItem = $sellerItem;
	    $this->buyerItem = $buyerItem;
	    $this->sellerAmount = $sellerAmount;
	    $this->buyerAmount = $buyerAmount;
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
