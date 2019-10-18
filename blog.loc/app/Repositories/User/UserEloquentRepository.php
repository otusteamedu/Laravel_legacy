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
        $user = User::findOrFail($userId);

        return $user;
    }

    public function add(array $userData)
    {
        $user = User::create($userData);

        return $user;
    }

    public function update(int $userId, array $userData)
    {
        $user = User::where('id', $userId)
            ->update($userData);

        return $user;
    }

    public function activate(int $userId)
    {
        User::where('id', $userId)
            ->update([
                'status' => User::STATUS_ACTIVE,
            ]);
    }

    public function deactivate(int $userId)
    {
        User::where('id', $userId)
            ->update([
                'status' => User::STATUS_UNACTIVE,
            ]);
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