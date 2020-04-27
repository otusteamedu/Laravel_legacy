<?php

namespace App\Services\Languages\Repositories;

use App\Models\Language;
use Carbon\Carbon;
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
        $languagePaginateCacheKey = 'languagePaginate_' . serialize($filters);
        $languagePaginator = \Cache::driver('redis')->tags([Language::class])->remember(
            $languagePaginateCacheKey,
            Carbon::now()->addSeconds(\Config::get('cache.cache_time.language_list')),
            function () use ($filters) {
                $language = Language::query();
                $this->applyFilters($language, $filters);

                return $language->paginate();
            }
        );

        return $languagePaginator;

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

    public function delete(int $id)
    {

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

        if (isset($filters['code'])) {
            $queryBuilder->where('code', $filters['code']);
        }
    }
}
