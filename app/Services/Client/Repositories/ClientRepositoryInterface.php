<?php


namespace App\Services\Client\Repositories;


use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ClientRepositoryInterface
{
    /**
     * Return client information
     * @param int $clientId
     * @return User
     */
    public function getById(int $clientId): User;

    /**
     * Return client's list
     * @var int $masterId - master's identifier
     * @var bool $pagination - pagination flag
     * @return Collection|null
     */
    public function getPaginationList(int $masterId = 0): ?LengthAwarePaginator;

    /**
     * @param User $client
     * @return mixed
     */
    public function save(User $client);

    /**
     * @param int $masterId
     * @return mixed
     */
    public function getList(int $masterId);

    /**
     * @param User $masterUser
     * @param array $userData
     * @return User|null
     */
    public function create(User $masterUser, array $userData): ?User;

    /**
     * @return int
     */
    public function getLastUserId(): int;
}
