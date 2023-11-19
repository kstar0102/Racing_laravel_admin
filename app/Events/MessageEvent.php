<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $highest_bidder;
    public $highest_bid_amount;
    public $horse_id;
    public $remain_bidding_time;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($bidder, $bid_amount, $id, $remain_bidding_time)
    {
        //
        $this->highest_bidder = $bidder;
        $this->highest_bid_amount = $bid_amount;
        $this->horse_id = $id;
        $this->remain_bidding_time = $remain_bidding_time;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-name');
    }
}
