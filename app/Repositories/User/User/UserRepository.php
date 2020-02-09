<?php

namespace App\Repositories\User\User;

use App\Models\User\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

/**
 * Class UserRepository
 * @package App\Repositories\User\User
 */
class UserRepository implements UserRepositoryInterface
{
    /** @inheritDoc */
    public function all(): Collection
    {
        return User::all();
    }

    /** @inheritDoc */
    public function paginationList(array $options = []): LengthAwarePaginator
    {
        $query = $this->buildQuery($options);
        return $query->paginate();
    }

    /**
     * @param array $options
     * @return Builder
     */
    protected function buildQuery(array $options): Builder
    {
        $query = User::query();
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
    public function find(int $id): User
    {
        return User::findOrFail($id);
    }

    /** @inheritDoc */
    public function createFromArray(array $data): User
    {
        $user = new User($data);
        $user->saveOrFail($data);
        return $user;
    }

    /** @inheritDoc */
    public function updateFromArray(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    /** @inheritDoc */
    public function delete(User $user): void
    {
        $user->delete();
    }
}