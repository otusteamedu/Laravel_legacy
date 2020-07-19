<?php

namespace App\Repository\Cache;

use App\Models\CacheTime;

interface CacheTimeRepositoryInterface
{
     function getCacheConstructionSecond() :int;
}
