<?php

namespace App\Repository\Cache;

use App\Models\CacheTag;

class CacheTagRepository implements CacheTagRepositoryInterface
{

    public function getConstructionTag()
    {
        return CacheTag::CONSTRUCTION;
    }
}
