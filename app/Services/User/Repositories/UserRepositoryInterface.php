<?php

namespace App\Services\User\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;
    public function getPage(int $page = 1, int  $perPage = 20, string $search = null): array;
    public function findWith(int $id, array $relations): ?User;
}
