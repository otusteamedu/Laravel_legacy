<?php


namespace App\Services\Filters\Repositories;


use App\Models\Filter;
use Illuminate\Database\Eloquent\Collection;

interface CachedFilterRepositoryInterface
{
    public function search(array $filters = [], array $with = []);

    public function clearSearchCache();

    public function find(int $id);

    public function clearFilterCache(Filter $country);

    public function warmup();

    public function getBy(array $filters = [], array $with = []): Collection;
}
