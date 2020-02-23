<?php

namespace App\Repositories\User\Right;

use App\Models\User\Right;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class RightRepository
 * @package App\Repositories\User\Right
 */
class RightRepository implements RightRepositoryInterface
{

    /** @inheritDoc */
    public function all(): Collection
    {
        return Right::all();
    }

    /** @inheritDoc */
    public function paginationList(array $options): LengthAwarePaginator
    {
        $query = $this->buildQuery($options);
        return $query->paginate();
    }

    /** @inheritDoc */
    public function arrayList(array $options): array
    {
        $query = $this->buildQuery($options);
        return $query->pluck('name', 'id')->toArray();
    }

    /**
     * @param array $options
     * @return Builder
     */
    protected function buildQuery(array $options): Builder
    {
        $query = Right::query();
        foreach ($options as $key=>$value) {
            switch ($key) {
                case 'with':
                    $query->with($value);
                    break;
                case 'order':
                    $query->orderBy($value['column'], $value['order']);
                    break;
            }
        }
        return $query;
    }
}