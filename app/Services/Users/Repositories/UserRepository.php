<?php
/**
 * Description of UserRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Users\Repositories;


use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{

    /**
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @param array $filters
     * @param array $with
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection
     */
    public function search(array $filters = [], array $with = []): LengthAwarePaginator
    {
        return User::with($with)->paginate();
    }

    /**
     * @param array $data
     * @return User
     */
    public function createFromArray(array $data): User
    {
        $model = new User();
        $model->create($data);
        return $model;
    }

    /**
     * @param User $model
     * @param array $data
     * @return User
     */
    public function updateFromArray(User $model, array $data): User
    {
        $model->update($data);
        return $model;
    }
}