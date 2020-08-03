<?php

namespace App\Services\Admin\Businesses;

use App\Models\Business;
use App\Services\Admin\Businesses\DTOs\BusinessCreateDTO;
use App\Services\Admin\Businesses\DTOs\BusinessUpdateDTO;
use App\Services\Admin\Businesses\Handlers\BusinessCreateHandler;
use App\Services\Admin\Businesses\Handlers\BusinessDeleteHandler;
use App\Services\Admin\Businesses\Handlers\BusinessUpdateHandler;
use App\Services\Admin\Businesses\Repositories\BusinessRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

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
     * Списк всех салонов
     * @return Collection|null
     */
    public function list(): ?Collection
    {
        $business = $this->repository->get();
        return $business;
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
