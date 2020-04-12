<?php

namespace App\Services\Events\Repositories;

use App\Models\Event;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EloquentEventRepository
 * @package App\Services\Events\Repositories
 */
class EloquentEventRepository implements EventRepositoryInterface
{
    public function find(int $id)
    {
        return Event::find($id);
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        $event = Event::query();
        $this->applyFilters($event, $filters);

        return $event->paginate(10);
    }

    public function createFromArray(array $data): Event
    {
        $event = new Event();

        try {
            $event->fill($data)->save(); // @ToDo: выяснить, почему вариант кода $event->create($data); не возвращет событие
        } catch (\Throwable $exception) {
            \Log::error('Impossible to create event by params array', $data);

            return 'Произошла ошибка при сохранении:'
                . $exception->getMessage(); // @ToDo: прикрутить обработку ошибок и их вывод на экран
        }

        return $event;
    }

    public function updateFromArray(Event $event, array $data)
    {
        $event->update($data);
        return $event;
    }

    public function delete(int $id) {

    }

    /**
     * @param Builder $queryBuilder
     * @param array $filters
     */
    private function applyFilters(Builder $queryBuilder, array $filters) {
        if (isset($filters['region'])) {
            $queryBuilder->where('region', $filters['region']);
        }

        if (isset($filters['locality'])) {
            $queryBuilder->where('locality', $filters['locality']);
        }

        if (isset($filters['is_solved'])) {
            $queryBuilder->where('is_solved', $filters['is_solved']);
        }
    }
}
