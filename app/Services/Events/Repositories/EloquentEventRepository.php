<?php

namespace App\Services\Events\Repositories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class EloquentEventRepository
 * @package App\Services\Events\Repositories
 */
class EloquentEventRepository implements EventRepositoryInterface
{
    public function find(int $eventId)
    {
        $event = Event::with('getType', 'pictures', 'getCountry', 'getAuthor', 'participants')->find($eventId);

        return $event;
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        $pageSize = 10; // @ToDo: подумать, куда вынести магическое число

        $event = Event::query();
        $this->applyFilters($event, $filters);

        // @ToDo: вынести набор полей выше. Репозиторий не должен содержать эту логику.
        return $event->with('getType', 'pictures', 'getCountry', 'getAuthor')->paginate($pageSize);
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
