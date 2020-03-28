<?php

namespace App\Services\Users\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{

    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): User;

    public function updateFromArray(User $segment, array $data);

}
