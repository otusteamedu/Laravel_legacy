<?php

namespace App\Services\Events\Cache;


use App\Models\Event;
use App\Services\Events\Repositories\CacheEventRepositoryInterface;
use App\Services\Events\Repositories\EventRepositoryInterface;

class WarmUpCacheEventsService
{
    /**
     * @var EventRepositoryInterface
     */
    private $eventRepository;
    /**
     * @var CacheEventRepositoryInterface
     */
    private $cacheEventRepository;

    public function __construct(
        EventRepositoryInterface $eventRepository,
        CacheEventRepositoryInterface $cacheEventRepository
    )
    {
        $this->eventRepository = $eventRepository;
        $this->cacheEventRepository = $cacheEventRepository;
    }

    public function warmAll()
    {
        $this->warmSearch();
        $this->warmShowEvents();
    }

    public function warmSearch()
    {
        $this->cacheEventRepository->search();
    }

    public function warmShowEvents()
    {
        $events = $this->eventRepository->search();

        foreach ($events as $event) {
            $this->warmShowEvent($event);
        }
    }

    public function warmShowEvent(Event $event)
    {
        $this->cacheEventRepository->find($event->id);
    }
}
