<?php

namespace App\Services\News\Repositories;

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder ;

/**
 * Class EloquentNewsRepository
 * @package App\Services\News\Repositories
 */
class EloquentNewsRepository implements NewsRepositoryInterface
{
    public function find(int $id)
    {
        return News::find($id);
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        $news = News::query();
        $this->applyFilters($news, $filters);

        return $news->paginate();
    }

    public function createFromArray(array $data): News
    {
        $news = new News();

        try {
            $news->fill($data)->save();
        } catch (\Throwable $exception) {
            return 'Произошла ошибка при сохранении:'
                . $exception->getMessage();
        }

        return $news;
    }

    public function updateFromArray(News $news, array $data)
    {
        $news->update($data);

        return $news;
    }

    public function delete(int $id) {

    }

    /**
     * @param Builder $queryBuilder
     * @param array $filters
     */
    private function applyFilters(Builder $queryBuilder, array $filters) {

        if (isset($filters['name'])) {
            $queryBuilder->where('name', $filters['name']);
        }
    }
}
