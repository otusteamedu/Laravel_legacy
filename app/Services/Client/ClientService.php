<?php

namespace App\Services\Client;

use App\Models\User;
use App\Services\Client\Repositories\ClientRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ClientService
{
    protected ClientRepositoryInterface $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Get master clients (with pagination)
     * @param int $masterId
     * @return LengthAwarePaginator|null
     */
    public function getMasterClientsPagination(int $masterId): ?LengthAwarePaginator
    {
        return $this->clientRepository->getPaginationList($masterId);
    }

    /**
     * Get master clients (without pagination)
     * @param int $masterId
     * @return mixed
     */
    public function getMasterClients(int $masterId): Collection
    {
        return $this->clientRepository->getList($masterId);
    }

    /**
     * Get master client
     * @param int $clientId
     * @return User
     */
    public function getMasterClient(int $clientId): User
    {
        return $this->clientRepository->getById($clientId);
    }

    /**
     * @param int $masterId
     * @param array $userData
     * @return User|null
     */
    public function createClient(int $masterId, array $userData): ?User
    {
        if (empty($userData['email'])) {
            $userData['email'] = $this->generateFakeEmail();
        }

        return $this->clientRepository->create($masterId, $userData);
    }

    /**
     * @return string
     */
    protected function generateFakeEmail(): string
    {
        $lastUserId = Cache::rememberForever('lastUserId', function () {
            return $this->clientRepository->getLastUserId();
        });

        return sprintf('%s@fakeclient.ru', ++$lastUserId);
    }
}
