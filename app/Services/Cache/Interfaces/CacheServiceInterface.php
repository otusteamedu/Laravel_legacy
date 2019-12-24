<?php

declare(strict_types=1);

namespace App\Services\Cache\Interfaces;

use App\Models\User;

interface CacheServiceInterface
{
    public static function getCacheKey(array $params = []): string;

    public function warmupCacheByUser(User $user): void;
}
