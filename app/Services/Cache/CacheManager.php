<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Cache;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheManager implements CacheManagerInterface
{

    /**
     * @inheritDoc
     */
    public function publicCacheKey(?string $route = null) :string
    {
        $key = $route ?? request()->fullUrl();
        Log::info($key);

        return md5($key);
    }

    /**
     * @inheritDoc
     */
    public function authCacheKey(?string $route = null) :string
    {
        $key[] = Auth::id();
        $key[] = $route ?? request()->fullUrl();
        $key = implode('|', $key);

        Log::info($key);

        return md5($key);
    }

    /**
     * @inheritDoc
     */
    public function clearKey(string $key) :bool
    {
        Log::info('clearKey|'.$key);

        return Cache::forget($key);
    }

    /**
     * @inheritDoc
     */
    public function flushTags($tags) :void
    {
        Log::info('flushTags');
        Cache::tags($tags)->flush();
    }


}