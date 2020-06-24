<?php


namespace App\Services\Filters\Repositories;


use App\Models\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class EloquentFilterRepository implements FilterRepositoryInterface
{

    const DEFAULT_CACHE_TTL = 100;

    public function find(int $id)
    {
        return Filter::find($id);
    }

    public function search(array $filters = []): LengthAwarePaginator
    {
//        return Filter::paginate();
        $query = Filter::query()->with(
            [
                'filterTypes' => function ($query) {
                    $query ->select(['id', 'name'])
//->remember(self::DEFAULT_CACHE_TTL)
//                        ->cacheTags('filterTypes')
                       ;
                },
                'users' => function ($query) {
                    $query->select(['id', 'name'])
//->remember(self::DEFAULT_CACHE_TTL)
//                        ->cacheTags('owners')
                        ;
                },
//                'filterTypes:id,name',
//                'users:id,name'
            ]);

        $query->remember(self::DEFAULT_CACHE_TTL);
        $query->cacheTags('filters');
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function searchRemember(array $filters = []): LengthAwarePaginator
    {
//        return Filter::paginate();
        $query = Filter::query()->with(
            [
                'filterTypes' => function ($query) {
                    $query->remember(self::DEFAULT_CACHE_TTL)
                        ->cacheTags('filterTypes')
                        ->select(['id', 'name']);
                },
                'users' => function ($query) {
                    $query->remember(self::DEFAULT_CACHE_TTL)
                        ->cacheTags('owners')
                        ->select(['id', 'name']);
                },
//                'filterTypes:id,name',
//                'users:id,name'
            ]);

        $query->remember(self::DEFAULT_CACHE_TTL);
        $query->cacheTags('filters');
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function getFiltersByFilterType(string $filterType)
    {
        return Filter::where('continent_name', $filterType)
            ->get();
    }

    public function createFromArray(array $data): Filter
    {
//        $filter = new Filter();
//        $filter->create($data);
        return Filter::create($data);
    }

    public function updateFromArray(Filter $filter, array $data)
    {
        $filter->update($data);
        return $filter;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }

    /**
     * @param array $filters
     * @param array $with
     * @return Filter[]|Collection
     */
    public function getBy(array $filters = [], array $with = []) :Collection
    {
        return Filter::with($with)->get();
    }

}
