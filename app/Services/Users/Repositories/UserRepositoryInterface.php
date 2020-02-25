<?php

namespace App\Services\Users\Repositories;

use App\Models\User;

/**
 * Interface UserRepositoryInterface
 * @package App\Services\Users\Repositories
 */
interface UserRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): User;

    public function updateFromArray(User $user, array $data);

    public function delete(int $id);
}
