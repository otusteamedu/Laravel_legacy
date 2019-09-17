<?php

namespace App\Repositories\User;


use App\Models\User\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function get(array $filters)
    {
        $users = User::get();

        return $users;
    }

    public function getById(int $id)
    {
        $users =  User::where('id', $id)->get();

        return $users;
    }

    public function change(int $id, array $data)
    {
        // TODO: Implement change() method.
    }

    public function changePassword(int $id, string $newPassword)
    {
        // TODO: Implement changePassword() method.
    }

    public function changeStatus(int $id, string $newStatus)
    {
        // TODO: Implement changeStatus() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}