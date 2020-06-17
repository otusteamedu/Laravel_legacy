<?php

namespace App\Services\Events\Repositories;

use App\Services\Cache\Tag;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CacheEventRepository
 * @package App\Services\Events\Repositories
 */
class CacheEventRepository implements CacheEventRepositoryInterface
{
    private $eventRepository;

    public function __construct(
        EventRepositoryInterface $eventRepository
    ) {
        $this->eventRepository = $eventRepository;
    }

    public function find(int $eventId) {
        $eventCacheKey = 'event_' . $eventId;

        return \Cache::tags([Tag::PUBLIC, Tag::EVENTS])->remember(
            $eventCacheKey,
            Carbon::now()->addSeconds(\Config::get('cache.cache_time.event_detail')),
            function () use ($eventId) {
                return $this->eventRepository->find($eventId);
            }
        );
    }

    public function search(array $filters = []): ?LengthAwarePaginator
    {
        $pageSize = 10; // @ToDo: подумать, куда вынести магическое число
        $eventPaginateCacheKey = 'eventPaginate_' . md5(serialize($filters)) . $pageSize;

        return \Cache::tags([Tag::PUBLIC, Tag::EVENTS])->remember(
            $eventPaginateCacheKey,
            Carbon::now()->addSeconds(\Config::get('cache.cache_time.event_list')),
            function () use ($filters, $pageSize) {
                return $this->eventRepository->search($filters);
            }
        );
    }

    public function clear() {
        \Cache::tags([Tag::PUBLIC, Tag::EVENTS])->flush();
    }

    public function getBy(array $filters = [], array $with = []): Collection
    {
        $eventCollectionCacheKey = 'eventCollection_' . md5(serialize($filters)) . md5(serialize($with));

        return \Cache::tags([Tag::PUBLIC, Tag::EVENTS])->remember(
            $eventCollectionCacheKey,
            Carbon::now()->addSeconds(\Config::get('cache.cache_time.event_list')),
            function () use ($filters, $with) {
                return $this->eventRepository->getBy($filters, $with);
            }
        );
    }
}
