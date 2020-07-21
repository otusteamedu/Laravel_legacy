<?php

namespace App\Services\BusinessTypes;

use App\Models\BusinessType;
use App\Services\BusinessTypes\DTOs\BusinessTypeDTO;
use App\Services\BusinessTypes\Handlers\BusinessTypeCreateHandler;
use App\Services\BusinessTypes\Repositories\BusinessTypeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BusinessTypeService
{

    /**
     * @var BusinessTypeCreateHandler
     */
    private $createHandler;
    /**
     * @var BusinessTypeRepositoryInterface
     */
    private $repository;

    public function __construct(
        BusinessTypeCreateHandler $createHandler,
        BusinessTypeRepositoryInterface $repository
    )
    {
        $this->createHandler = $createHandler;
        $this->repository = $repository;
    }

    /**
     * Регистрация пользователя
     * @param array $data
     * @return BusinessType
     */
    public function create(array $data): BusinessType
    {
        $type =  BusinessTypeDTO::fromArray([

        ]);

        return $this->createHandler->handle($type);
    }

    /**
     * Списк всех типов
     * @return Collection|null
     */
    public function list(): ?Collection
    {
        return $this->repository->get();
    }
}
