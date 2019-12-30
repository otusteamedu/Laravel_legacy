<?php


namespace App\Services\Admin\Users\Handlers;


use App\Services\Admin\Users\Repositories\UsersRepository;


/**
 * Class GetUserByIdHandler
 * @package App\Services\Admin\Users\Handlers
 */
class GetUserByIdHandler
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;


    /**
     * GetUserByIdHandler constructor.
     * @param UsersRepository $repository
     */
    public function __construct(UsersRepository $repository)
    {
        $this->usersRepository = $repository;
    }


    /**
     * @param int $id
     * @return string
     */
    public function handle(int $id)
    {
        return $this->usersRepository->getUserById($id)->toJson();
    }
}
