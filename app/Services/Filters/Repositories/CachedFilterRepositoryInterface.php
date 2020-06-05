<?php


namespace App\Services\Filters\Repositories;


use App\Models\Filter;

interface CachedFilterRepositoryInterface
{
    public function search(array $filters = [], array $with = []);

    public function clearSearchCache();

    public function find(int $id);

    public function clearFilterCache(Filter $country);

    public function warmup();
}
