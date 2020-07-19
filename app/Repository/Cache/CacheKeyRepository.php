<?php

namespace App\Repository\Cache;

use App\Models\CacheKey;

class CacheKeyRepository implements CacheKeyRepositoryInterface
{

    public function getConstructionKeyPrefix()
    {
        return CacheKey::CONSTRUCTION_PREFIX ;
    }
}
