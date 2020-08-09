<?php

namespace App\Services\Businesses;

use App\Models\Business;
use App\Services\Businesses\DTOs\BusinessCreateDTO;
use App\Services\Businesses\DTOs\BusinessUpdateDTO;
use App\Services\Businesses\Handlers\BusinessCreateHandler;
use App\Services\Businesses\Handlers\BusinessDeleteHandler;
use App\Services\Businesses\Handlers\BusinessUpdateHandler;
use App\Services\Businesses\Repositories\BusinessRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

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
     * Списк всех типов
     * @param int $id
     * @return Collection|null
     */
    public function get(int $id): ?Business
    {
        return $this->repository->find($id);
    }

    /**
     * Списк всех типов
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
