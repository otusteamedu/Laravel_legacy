<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Attempting;
use Arr;

class LogAuthenticationAttempt
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
     * @param  Attempting  $event
     * @return void
     */
    public function handle(Attempting $event)
    {
        \Log::info(self::class, [Arr::except($event->credentials, ['password'])]);
    }
}
