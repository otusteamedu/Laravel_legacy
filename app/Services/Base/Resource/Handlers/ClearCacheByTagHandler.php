<?php


namespace App\Services\Base\Resource\Handlers;

use Illuminate\Support\Facades\Cache;

class ClearCacheByTagHandler
{
    /**
     *  Clear categories cache
     * @param string $cacheTag
     */
    public function handle(string $cacheTag)
    {
        ($cacheTag !== '') && Cache::tags($cacheTag)->flush();
    }
}
