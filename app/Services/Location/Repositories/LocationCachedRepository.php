<?php

declare(strict_types=1);

namespace App\Services\Location\Repositories;

use App\Models\User;
use App\Services\Cache\CacheService;
use App\Services\Location\Interfaces\LocationCachedRepositoryInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class LocationCachedRepository implements LocationCachedRepositoryInterface
{

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
     *   - user_id
     * @param  array  $filters
     * @param  string  $path
     * @return Location|Collection|static[]|static|null
     */
    public function searchCached(array $conditions = ['user_id' => 0], array $filters = [], string $path = '')
    {
        $cacheKey = CacheService::getCacheKey(array_merge($conditions, $filters));

        return Cache::tags([
            CacheService::getCacheUserTagByModel(Location::class).$conditions['user_id']
        ])->remember(
            $cacheKey,
            CacheService::CACHE_TTL,
            function () use ($conditions, $filters, $path) {
                return $this->locationRepository->search($conditions, $filters, $path);
            }
        );
    }

    /**
     * Clear search cache.
     *
     * @param  array  $conditions
     *   - user_id
     */
    public function clearSearchCache(array $conditions = ['user_id' => 0])
    {
        Cache::tags([
            CacheService::getCacheUserTagByModel(Location::class).$conditions['user_id']
        ])->flush();
    }

    /**
     * @inheritDoc
     */
    public function warmupCacheByUser(User $user)
    {
        $conditions = [
            'user_id' => $user->id
        ];
        $filters = [];
        // @todo Прогревать кэш для всех страниц
        $this->searchCached($conditions, $filters, route('backend.location.index'));
    }

}
