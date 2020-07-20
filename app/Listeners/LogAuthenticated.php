<?php

namespace App\Listeners;

use Log;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogAuthenticated
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
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        Log::channel('')->emergency(self::class, [
            'id' => $event->user->getAuthIdentifier(),
            'url' => request()->url(),
        ]);
    }
}