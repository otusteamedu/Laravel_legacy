<?php

namespace App\Services\Traits;

use Illuminate\Support\Facades\Cache;

/**
 * Class CacheClearable
 * @package App\Services\Traits
 */
trait CacheClearable
{
    public function clearCache(): void
    {
        Cache::tags(static::CACHE_TAG)->flush();
    }
}
