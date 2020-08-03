<?php

namespace App\Services\Admin\Businesses\Handlers;

use App\Models\Business;
use App\Services\Admin\Businesses\DTOs\BusinessUpdateDTO;
use App\Services\Admin\Businesses\Repositories\BusinessRepositoryInterface;

class BusinessUpdateHandler
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

    public function handle(BusinessUpdateDTO $businessDTO, Business $business): Business
    {
        $business->setRawAttributes($businessDTO->toArray());
        return $this->repository->update($business);
    }
}
