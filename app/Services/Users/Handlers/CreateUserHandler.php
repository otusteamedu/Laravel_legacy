<?php


namespace App\Services\Users\Handlers;


use App\Models\User;
use App\Services\Users\Repositories\UsersRepositoryInterface;

class CreateUserHandler
{

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    public function __construct(
        UsersRepositoryInterface $usersRepository
    )
    {
        $this->usersRepository = $usersRepository;
    }


    public function handle(array $data): User
    {
        return $this->usersRepository->createFromArray($data);
    }
}
