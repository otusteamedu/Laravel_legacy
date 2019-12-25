<?php

declare(strict_types=1);

namespace App\Services\Cache\Interfaces;

use App\Models\User;

interface CacheServiceInterface
{
    /**
     * Get cache key for given params.
     *
     * @param  array  $params
     * @return string
     */
    public static function getCacheKey(array $params = []): string;

    /**
     * Get cache user tag for given Model.
     *
     * @param  string  $modelClass
     * @return string
     */
    public static function getCacheUserTagByModel(string $modelClass): string;

    /**
     * Warmup cache for user.
     *
     * @param  User  $user
     */
    public function warmupCacheByUser(User $user): void;
}
