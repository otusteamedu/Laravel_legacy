<?php


namespace App\Services\Filters\Repositories;


use App\Models\Filter;
use Illuminate\Database\Eloquent\Collection;


interface FilterRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Filter;

    public function updateFromArray(Filter $filter, array $data);

    public function getBy(array $filters = [], array $with = []) : Collection;
}
