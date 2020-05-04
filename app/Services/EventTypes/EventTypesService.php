<?php

namespace App\Services\EventTypes;

use App\Models\EventType;
use App\Services\EventTypes\Repositories\EventTypeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventTypesService
{
    private $eventTypeRepository;

    public function __construct(
        EventTypeRepositoryInterface $eventTypeRepository
    ) {
        $this->eventTypeRepository = $eventTypeRepository;
    }

    /**
     * @param int $id
     * @return EventType|null
     */
    public function findEventType(int $id)
    {
        return $this->eventTypeRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchEventTypes(array $filters): LengthAwarePaginator
    {
        return $this->eventTypeRepository->search($filters);
    }
}
