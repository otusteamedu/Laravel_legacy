<?php

namespace App\Listeners\Cache;

use Log;
use Illuminate\Cache\Events\CacheHit;

class CacheHitEventListener
{

    /**
     * @param CacheHit $event
     */
    public function handle(CacheHit $event)
    {
        if (config('app.env') === 'local') {
            Log::info('Cache Hit', [
                $event->key,
                $event->value,
                $event->tags,
            ]);
        }
    }
}