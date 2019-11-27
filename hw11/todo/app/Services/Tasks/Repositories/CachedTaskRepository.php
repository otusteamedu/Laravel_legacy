<?php

namespace App\Services\Tasks\Repositories;

use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class CachedTaskRepository implements CachedTaskRepositoryInterface
{

    const CACHE_SEARCH_SECONDS = 60;

    /** @var TaskRepositoryInterface */
    private $taskRepository;
    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        CacheKeyManager $cacheKeyManager
    )
    {
        $this->taskRepository = $taskRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    /**

     * @return taskRepository::search
     */
    public function search(array $filters = [], array $with = []):LengthAwarePaginator
    {
        $key = $this->cacheKeyManager->getSearchTasksKey($filters);

        return Cache::tags([Tag::TASKS])->
            remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
            return $this->taskRepository->search($filters, $with);
        });
    }

    public function clearSearchCache()
    {
        Cache::tags([Tag::TASKS])->flush();
    }

}