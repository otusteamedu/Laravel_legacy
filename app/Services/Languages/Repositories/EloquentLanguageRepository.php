<?php

namespace App\Services\Languages\Repositories;

use App\Models\Language;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EloquentLanguageRepository
 * @package App\Services\Languages\Repositories
 */
class EloquentLanguageRepository implements LanguageRepositoryInterface
{
    public function find(int $id)
    {
        $language = Language::find($id);

        return $language;
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
        $language = Language::query();
        $this->applyFilters($language, $filters);

        return $language->paginate();
    }

    public function createFromArray(array $data): Language
    {
        $language = new Language();

        try {
            $language->fill($data)->save();
        } catch (\Throwable $exception) {
            \Log::error('Impossible to create language by params array', $data);

            return 'Произошла ошибка при сохранении:'
                . $exception->getMessage();
        }

        return $language;
    }

    public function updateFromArray(Language $language, array $data)
    {
        $language->update($data);

        return $language;
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

        if (isset($filters['code'])) {
            $queryBuilder->where('code', $filters['code']);
        }
    }
}
