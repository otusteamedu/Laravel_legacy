<?php

namespace App\Repositories\User\Group;

use App\Models\User\Group;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GroupRepository
 * @package App\Repositories\User\Group
 */
class GroupRepository implements GroupRepositoryInterface
{
    /** @inheritDoc */
    public function all(): Collection
    {
        return Group::all();
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
        $query = Group::query();
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
    public function find(int $id): Group
    {
        return Group::findOrFail($id);
    }

    /** @inheritDoc */
    public function createFromArray(array $data): Group
    {
        $rights = $data['rights'] ?? [];
        unset($data['rights']);

        $group = new Group($data);
        $group->saveOrFail($data);

        $group->rights()->attach($rights);

        return $group;
    }

    /** @inheritDoc */
    public function updateFromArray(Group $group, array $data): Group
    {
        $rights = $data['rights'] ?? [];
        unset($data['rights']);

        $group->update($data);

        $group->rights()->sync($rights);

        return $group;
    }

    /** @inheritDoc */
    public function delete(Group $group): void
    {
        $group->delete();
    }
}