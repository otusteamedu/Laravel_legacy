<?php


namespace App\Services\Filters\Repositories;


use App\Models\Filter;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentFilterRepository implements FilterRepositoryInterface
{

    public function find(int $id)
    {
        return Filter::find($id);
    }

    public function search(array $filters = []) :LengthAwarePaginator
    {
        return Filter::paginate();
    }

    public function getFiltersByFilterType(string $filterType)
    {
        return Filter::where('continent_name', $filterType)
            ->get();
    }

    public function createFromArray(array $data): Filter
    {
        $filter = new Filter();
        $filter->create($data);
        return $filter;
    }

    public function updateFromArray(Filter $filter, array $data)
    {
        $filter->update($data);
        return $filter;
    }

}
