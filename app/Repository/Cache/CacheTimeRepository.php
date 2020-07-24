<?php

namespace App\Repository\Cache;
use App\Models\CacheTime;


class CacheTimeRepository implements CacheTimeRepositoryInterface
{

    public function getCacheConstructionSecond():int
    {
         return CacheTime::CONSTRUCTION_SECOND;
    }
}
