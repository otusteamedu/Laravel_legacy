<?php


namespace App\Services\Users\Repositories;


use App\Models\User;

class EloquentUsersRepository implements UsersRepositoryInterface
{

    public function find(int $id)
    {
        return User::whereId($id)->first();
    }

    public function search(array $filters = [], int $limit = 20)
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
}
