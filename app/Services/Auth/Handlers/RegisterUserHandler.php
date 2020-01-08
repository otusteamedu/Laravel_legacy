<?php


namespace App\Services\Auth\Handlers;


use App\Services\Auth\Repositories\AuthRepository;

/**
 * Class RegisterUserHandler
 * @package App\Services\Auth\Handlers
 */
class RegisterUserHandler
{
    /**
     * @var AuthRepository
     */
    private $repository;

    /**
     * RegisterUserHandler constructor.
     * @param AuthRepository $repository
     */
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return \App\Models\User
     */
    public function handle(array $data)
    {
        return $this->repository->registerNewUser($data);
    }
}
