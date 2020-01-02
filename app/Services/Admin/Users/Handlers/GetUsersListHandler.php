<?php


namespace App\Services\Admin\Users\Handlers;


use App\Services\Admin\Users\Repositories\UsersRepository;

/**
 * Class GetUsersListHandler
 * @package App\Services\Admin\Users\Handlers
 */
class GetUsersListHandler
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function handle()
    {
        return $this->usersRepository->getList();
    }
}
