<?php


namespace App\Services\Filters\Repositories;


use App\Models\Filter;
use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Illuminate\Database\Eloquent\Collection;
use Cache;

class CachedFilterRepository implements CachedFilterRepositoryInterface
{
    const CACHE_SEARCH_SECONDS = 60;
    /**
     * @var FilterRepositoryInterface
     */
    private FilterRepositoryInterface $filterRepository;
    /**
     * @var CacheKeyManager
     */
    private CacheKeyManager $cacheKeyManager;


    public function __construct(FilterRepositoryInterface $filterRepository,
                                CacheKeyManager $cacheKeyManager)
    {
        $this->filterRepository = $filterRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = [])
    {
        $key = $this->cacheKeyManager->getSearchFiltersKey($filters);

        return Cache::tags([Tag::CMS, Tag::FILTERS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->filterRepository->search($filters, $with);
            });

    }

    public function clearSearchCache()
    {
        Cache::tags([Tag::CMS, Tag::FILTERS])->flush();
    }

    public function find(int $id)
    {
        $key = $this->cacheKeyManager->getFilterKey($id);
        return Cache::tags([Tag::CMS, Tag::FILTERS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($id) {
                return $this->filterRepository->find($id);
            });
    }

    public function clearFilterCache(Filter $filter)
    {
        $key = $this->cacheKeyManager->getFilterKey($filter->id);
        Cache::forget($key);
        $this->clearSearchCache();
    }

    /**\
     *  Warmup Cache
     */
    public function warmup()
    {
        // list methods for warmup
        $this->search([], []);
    }


    public function getBy(array $filters = [], array $with = []): Collection
    {

        $key = $this->cacheKeyManager->getSearchFiltersKey($filters);

        return Cache::tags([Tag::CMS, Tag::FILTERS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use($filters, $with){
                return $this->filterRepository->getBy();
            });


    }

}
