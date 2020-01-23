<?php

namespace App\Events;

class WishlistEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin($event)
    {
       \Log::info(__METHOD__);
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event)
    {
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            WishlistTouched::class,
            'App\Events\WishlistEventSubscriber@handleUserLogin'
        );

        /*

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@handleUserLogout'
        );*/
    }
}
