<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\User\Repositories\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function getPage(int $page = 1, int  $perPage = 20, string $search = null): array
    {
        return $this->userRepository->getPage($page, $perPage, $search);
    }

    public function findWithOrders(int $id): ?User
    {
        return $this->userRepository->findWith($id, [
            'orders'
        ]);
    }
}
