<?php


namespace App\Services\User;


use App\Services\User\Repositories\ClientUserDetailRepository;

class ClientUserDetailService
{
    private ClientUserDetailRepository $repository;

    public function __construct(ClientUserDetailRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getItem()
    {
        return $this->repository->getItem();
    }

    public function update(array $requestData)
    {
        return $this->repository->update($requestData);
    }
}
