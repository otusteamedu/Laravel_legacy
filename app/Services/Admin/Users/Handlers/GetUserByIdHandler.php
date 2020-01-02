<?php


namespace App\Services\Admin\Users\Handlers;


use App\Services\Admin\Users\Repositories\UsersRepository;
use Illuminate\Support\Collection;


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
     * @return Collection
     */
    public function handle(int $id)
    {
        return new Collection($this->usersRepository->getUserById($id));
    }
}
