<?php

namespace App\Services\Admin\BusinessTypes\Handlers;

use App\Models\BusinessType;
use App\Services\Admin\BusinessTypes\Repositories\BusinessTypeRepositoryInterface;
use App\Services\Admin\BusinessTypes\DTOs\BusinessTypeDTO;

class BusinessTypeCreateHandler
{

    /**
     * @var BusinessTypeRepositoryInterface
     */
    private $repository;

    public function __construct(
        BusinessTypeRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function handle(BusinessTypeDTO $DTO): BusinessType
    {
        $businessType = $this->repository->create($DTO);
        return $businessType;
    }
}
