<?php

namespace App\Services\Businesses\Handlers;

use App\Models\Business;
use App\Services\Businesses\DTOs\BusinessUpdateDTO;
use App\Services\Businesses\Repositories\BusinessRepositoryInterface;

class BusinessDeleteHandler
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

    public function handle(Business $business): bool
    {
        return $this->repository->delete($business);
    }
}
