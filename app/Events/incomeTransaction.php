<?php

namespace App\Events;

use App\Transaction;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\UserResource;

class incomeTransaction
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
     * @param User $buyer
     * @param Transaction $trans
     */
	public function __construct(Transaction $trans)
	{
		//
		$this->seller = $trans->seller;
		$this->buyer = $trans->buyer;
		$this->sellerItem = UserResource::query()->find($trans->seller_resource_id)->resource_id;
		$this->buyerItem = UserResource::query()->find($trans->buyer_resource_id)->resource_id;
		$this->sellerAmount = $trans->seller_amount;
		$this->buyerAmount = $trans->buyer_amount;
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
