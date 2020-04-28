<?php

namespace App\Services\Events;


use App\Models\Event;
use App\Services\Events\Handlers\CreateEventHandler;
use App\Services\Events\Handlers\UpdateEventHandler;
use App\Services\Events\Handlers\DeleteEventHandler;
use App\Services\Events\Repositories\CacheEventRepositoryInterface;
use App\Services\Events\Repositories\EventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventsService
{
    private $createEventHandler;
    private $updateEventHandler;
    private $deleteEventHandler;
    private $eventRepository;
    private $cacheEventRepository;

    public function __construct(
        CreateEventHandler $createEventHandler,
        UpdateEventHandler $updateEventHandler,
        DeleteEventHandler $deleteEventHandler,
        EventRepositoryInterface $eventRepository,
        CacheEventRepositoryInterface $cacheEventRepository
    )
    {
        $this->createEventHandler = $createEventHandler;
        $this->updateEventHandler = $updateEventHandler;
        $this->deleteEventHandler = $deleteEventHandler;
        $this->eventRepository = $eventRepository;
        $this->cacheEventRepository = $cacheEventRepository;
    }

    /**
     * @param int $id
     * @return Event|null
     */
    public function findEvent(int $id)
    {
        return $this->cacheEventRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchEvents(array $filters): LengthAwarePaginator
    {
        return $this->cacheEventRepository->search($filters);
    }

    /**
     * @param array $data
     * @return Event
     */
    public function storeEvent(array $data): Event
    {
        return $this->createEventHandler->handle($data);
    }

    /**
     * @param Event $event
     * @param array $data
     * @return Event
     */
    public function updateEvent(Event $event, array $data): Event
    {
        return $this->updateEventHandler->handle($event, $data);
    }

    /**
     * @param Event $event
     */
    public function deleteEvent(Event $event) {
        return $this->deleteEventHandler->handle($event);
    }
}
