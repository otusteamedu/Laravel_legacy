<?php


namespace App\Services\Admin\Users\Handlers;


use App\Services\Admin\Users\Repositories\UsersRepository;


/**
 * Class CreateUserHandler
 * @package App\Services\Admin\Users\Handlers
 */
class CreateUserHandler
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * GetUsersListHandler constructor.
     * @param UsersRepository $repository
     */
    public function __construct(UsersRepository $repository)
    {
        $this->usersRepository = $repository;
    }

    /**
     * @param array $data
     * @return bool|integer
     */
    public function handle(array $data)
    {
        $user = $this->usersRepository->createUser($data);
        return $user ? $user->id : false;
    }
}
