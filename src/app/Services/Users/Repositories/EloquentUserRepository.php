<?php

namespace App\Services\Users\Repositories;

use App\Models\User;
use App\Services\Users\DTOs\RegisterDTO;

class EloquentUserRepository implements UserRepositoryInterface
{

    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function findByName(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    public function register(RegisterDTO $registerDTO): ?User
    {
        return User::create($registerDTO->toArray());
    }

    public function updateEmail(User $user, string $email): ?User
    {
        $user->update([
            'email' => $email
        ]);

        return $user;
    }
}
