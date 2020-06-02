<?php


namespace App\Services\Users\Repositories;


use App\Models\User;

class EloquentUsersRepository implements UsersRepositoryInterface
{

    public function find(int $id)
    {
        return User::whereId($id)->first();
    }

    public function search(array $groups, int $limit = 20)
    {
        return User::whereIn('group_id', $groups)->paginate($limit);
    }

    public function createFromArray(array $data): User
    {
        $user = new User();
        $user->create($data);
        return $user;
    }

    public function updateFromArray(User $user, array $data)
    {
        if (is_null($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
