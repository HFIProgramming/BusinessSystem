<?php

namespace App\Events;

use App\Config;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Logger
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $user;
	public $function;
	public $message;
	public $currentRound;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($user, $function, $message)
	{
		$this->user = $user;
		$this->function = $function;
		$this->message = $message;
		$this->currentRound = Config::KeyValue('current_round')->value;
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
