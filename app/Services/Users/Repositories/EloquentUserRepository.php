<?php

namespace App\Services\Users\Repositories;

use App\Models\User;

/**
 * Class EloquentUserRepository
 * @package App\Services\Users\Repositories
 */
class EloquentUserRepository implements UserRepositoryInterface
{
    public function find(int $id)
    {
        return User::find($id);
    }

    public function search(array $filters = [])
    {
        return User::paginate();
    }

    public function createFromArray(array $data): User
    {
        $user = new User();
        $user->create($data);

        return $user;
    }

    public function updateFromArray(User $user, array $data)
    {
        $user->update($data);

        return $user;
    }

    public function delete(int $id) {

    }
}
