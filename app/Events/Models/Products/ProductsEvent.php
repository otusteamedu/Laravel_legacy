<?php

namespace App\Events\Models\Products;

use App\Models\Products;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $products;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Products $products)
    {
        $this->products = $products;
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
