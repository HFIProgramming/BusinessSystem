<?php

namespace App\Events;

use App\Stock;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StockPriceChange
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $stock;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Stock $stock)
    {
        //
        $this->stock = $stock;
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
