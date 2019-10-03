<?php
/**
 * Created by PhpStorm.
 * User: romchik
 * Date: 03.10.19
 * Time: 22:55
 */

namespace App\Repositories\User;


use App\Models\User\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserEloquentRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        $users = User::all();

        return $users;
    }

    public function getById(int $userId)
    {
        // TODO: Implement getById() method.
    }

    public function add(array $userData)
    {
        $user = User::create($userData);

        return $user;
    }

    public function update(array $userData)
    {
        // TODO: Implement update() method.
    }

    public function activate(int $userId)
    {
        // TODO: Implement activate() method.
    }

    public function deactivate(int $userId)
    {
        // TODO: Implement deactivate() method.
    }

    public function changePassword(int $userId, string $newPassword)
    {
        // TODO: Implement changePassword() method.
    }

    public function delete(int $userId)
    {
        // TODO: Implement delete() method.
    }
}