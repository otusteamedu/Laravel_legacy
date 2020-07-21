<?php

namespace App\Services\Businesses\Handlers;

use App\Models\Business;
use App\Services\Businesses\DTOs\BusinessCreateDTO;
use App\Services\Businesses\Repositories\BusinessRepositoryInterface;

class BusinessCreateHandler
{

    /**
     * @var BusinessRepositoryInterface
     */
    private $repository;

    public function __construct(
        BusinessRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(BusinessCreateDTO $businessDTO): Business
    {
        $business = $this->repository->create($businessDTO);
        return $business;
    }
}
