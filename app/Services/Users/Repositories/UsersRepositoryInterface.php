<?php


namespace App\Services\Users\Repositories;


use App\Models\User;

interface UsersRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = [], int $limit = 20);

    public function createFromArray(array $data): User;

    public function updateFromArray(User $country, array $data);
}
