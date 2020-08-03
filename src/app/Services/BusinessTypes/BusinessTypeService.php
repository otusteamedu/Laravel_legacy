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
     * @var BusinessTypeRepositoryInterface
     */
    private $repository;

    public function __construct(
        BusinessTypeRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
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
