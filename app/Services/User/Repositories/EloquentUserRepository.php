<?php

namespace App\Services\User\Repositories;

use App\Services\User\Repositories\UserRepositoryInterface;
use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function getPage(int $page = 1, int  $perPage = 20, string $search = null): array
    {
        return User::getPage($page, $perPage, $search);
    }

    public function findWith(int $id, array $relations): ?User
    {
        $user = $this->find($id);

        if (!$user) {
            return null;
        }

        foreach ($relations as $relation) {
            $user->load($relation);
        }

        return $user;
    }
}
