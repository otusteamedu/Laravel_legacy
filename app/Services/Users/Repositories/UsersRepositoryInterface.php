<?php


namespace App\Services\Users\Repositories;


use App\Models\User;

interface UsersRepositoryInterface
{
    public function find(int $id);

    public function search(array $groups, int $limit = 20);

    public function createFromArray(array $data): User;

    public function updateFromArray(User $user, array $data);

    public function delete(User $user);
}
