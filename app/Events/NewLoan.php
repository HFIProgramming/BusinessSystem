<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewLoan
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $debtor, $creditor, $amount, $interest;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $debtor, User $creditor, $amount, $interest)
    {
        //
        $this->debtor = $debtor;
        $this->creditor = $creditor;
        $this->amount = $amount;
        $this->interest = $interest;
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
