<?php


namespace App\Services\Users\Handlers;


use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;

class CreateUserHandler
{

    private $userRepository;

    public function __construct(
        EloquentUserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function handle(array $data): User
    {
        return $this->userRepository->createFromArray($data);
    }

}
