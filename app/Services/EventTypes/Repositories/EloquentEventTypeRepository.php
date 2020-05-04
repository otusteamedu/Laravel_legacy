<?php

namespace App\Services\EventTypes\Repositories;

use App\Models\EventType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class EloquentEventTypeRepository
 * @package App\Services\EventTypes\Repositories
 */
class EloquentEventTypeRepository implements EventTypeRepositoryInterface
{
    public function find(int $eventTypeId)
    {
        $eventType = EventType::find($eventTypeId);

        return $eventType;
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        $eventType = EventType::query();
        $this->applyFilters($eventType, $filters);

        return $eventType->paginate();
    }

    /**
     * @param Builder $queryBuilder
     * @param array $filters
     */
    private function applyFilters(Builder $queryBuilder, array $filters)
    {
        if (isset($filters['name'])) {
            $queryBuilder->where('name', $filters['name']);
        }
    }
}
