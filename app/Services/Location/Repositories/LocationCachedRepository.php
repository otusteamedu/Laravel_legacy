<?php

declare(strict_types=1);

namespace App\Services\Location\Repositories;

use App\Services\Cache\CacheService;
use App\Services\Location\Interfaces\LocationCachedRepositoryInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class LocationCachedRepository implements LocationCachedRepositoryInterface {

    /**
     * @var LocationRepository $locationRepository
     */
    private $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Find and paginate a cached collection of records.
     *
     * @param  array  $conditions
     * @param  array  $filters
     * @return Location|Collection|static[]|static|null
     */
    public function searchCached(array $conditions = [], array $filters = [])
    {
        $cacheKey = CacheService::getCacheKey(array_merge($conditions, $filters));
        return Cache::remember(
            $cacheKey,
            CacheService::CACHE_TTL,
            function () use ($conditions, $filters) {
                return $this->locationRepository->search($conditions, $filters);
            }
        );
    }

}
