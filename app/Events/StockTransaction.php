<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StockTransaction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $stock;
    public $type;
    public $amount;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($stock, $type, $amount)
    {
        //
        $this->stock = $stock;
        $this->type = $type;
        $this->amount = $amount;
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
