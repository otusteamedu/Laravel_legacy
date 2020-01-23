<?php

namespace App\Listeners;

use App\Events\WishlistEventSubscriber;
use App\Events\WishlistTouched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearWishlistCache
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
     * @param WishlistTouched $event
     * @return void
     */
    public function handle(WishlistTouched $event)
    {
        \Log::info(__METHOD__);
    }
}
