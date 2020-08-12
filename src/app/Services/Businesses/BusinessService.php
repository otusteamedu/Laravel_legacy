<?php

namespace App\Services\Businesses;

use App\Models\Business;
use App\Services\Businesses\DTOs\BusinessCreateDTO;
use App\Services\Businesses\DTOs\BusinessUpdateDTO;
use App\Services\Businesses\Handlers\BusinessCreateHandler;
use App\Services\Businesses\Handlers\BusinessDeleteHandler;
use App\Services\Businesses\Handlers\BusinessUpdateHandler;
use App\Services\Businesses\Repositories\BusinessRepositoryInterface;
use App\Services\CacheKeyGeneration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BusinessService
{

    /**
     * @var BusinessCreateHandler
     */
    private $createHandler;
    /**
     * @var BusinessRepositoryInterface
     */
    private $repository;
    /**
     * @var BusinessUpdateHandler
     */
    private $updateHandler;
    /**
     * @var BusinessDeleteHandler
     */
    private $deleteHandler;

    public function __construct(
        BusinessCreateHandler $createHandler,
        BusinessUpdateHandler $updateHandler,
        BusinessDeleteHandler $deleteHandler,
        BusinessRepositoryInterface $repository
    )
    {
        $this->createHandler = $createHandler;
        $this->repository = $repository;
        $this->updateHandler = $updateHandler;
        $this->deleteHandler = $deleteHandler;
    }

    /**
     * Найти салон по ID
     * @param int $id
     * @return Collection|null
     */
    public function get(int $id): ?Business
    {
        $ttl = Business::CACHE_TTL;
        $prefix = Business::CACHE_PREFIX;
        $key = CacheKeyGeneration::getKey($prefix, $id);

        return Cache::remember($key, $ttl, function () use ($id) {
            $business = $this->repository->find($id);
            $business->procedures;
            $business->type;
            $business->address->contacts;

            return $business;
        });
    }

    /**
     * Списк всех салонов
     * @return Collection|null
     */
    public function getMyBusiness(): ?Business
    {
        return $this->repository->findByUserId(Auth::user()->id);
    }

    /**
     * Добавление салона
     * @param array $data
     * @return Business
     */
    public function create(array $data): Business
    {
        $business =  BusinessCreateDTO::fromArray($data);
        return $this->createHandler->handle($business);
    }

    /**
     * Обновить данные салона
     * @param array $data
     * @param Business $business
     */
    public function update(array $data, Business $business)
    {
        $businessDTO =  BusinessUpdateDTO::fromArray($data);
        $this->updateHandler->handle($businessDTO, $business);
    }

    /**
     * Удалить запись
     * @param Business $business
     */
    public function delete(Business $business)
    {
        $this->deleteHandler->handle($business);
    }
}
