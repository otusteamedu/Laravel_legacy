<?php

namespace App\Repositories\Post\Rubric;


use App\Models\Post\Rubric;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class RubricRepository
 * @package App\Repositories\Post\Rubric
 */
class RubricRepository implements RubricRepositoryInterface
{
    /** @inheritDoc */
    public function all(): Collection
    {
        return Rubric::all();
    }

    /** @inheritDoc */
    public function paginationList(array $options = []): LengthAwarePaginator
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
        $query = Rubric::query();
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

    /** @inheritDoc */
    public function find(int $id): Rubric
    {
        return Rubric::findOrFail($id);
    }

    /** @inheritDoc */
    public function createFromArray(array $data): Rubric
    {
        $rubric = new Rubric($data);
        $rubric->saveOrFail($data);
        return $rubric;
    }

    /** @inheritDoc */
    public function updateFromArray(Rubric $rubric, array $data): Rubric
    {
        $rubric->update($data);
        return $rubric;
    }

    /** @inheritDoc */
    public function delete(Rubric $rubric):void
    {
        $rubric->delete();
    }
}