<?php


namespace App\Services\API\User;


use App\Models\User;
use App\Services\API\User\Repositories\EloquentUserRepository;

class UserService
{
    private $userRepository;

    public function __construct(EloquentUserRepository $eloquentUserRepository)
    {
        $this->userRepository = $eloquentUserRepository;
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUser($id);
    }
}
