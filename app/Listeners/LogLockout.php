<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Lockout;

class LogLockout
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
     * @param  Lockout  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        \Log::info(self::class, [$event->request->all()]);
    }
}
