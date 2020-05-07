<?php

namespace App\Services\NeighborUsersOfEvent\Resolvers;

use App\Services\Users\UsersService;

class NeighborUsersByEventResolver
{
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function resolve(): array {
        // @ToDo: реализовать настоящее получение пользователей вместо заглушки
        $userArray = $this->usersService->searchUsers([])->items();

        return $userArray;
    }
}
