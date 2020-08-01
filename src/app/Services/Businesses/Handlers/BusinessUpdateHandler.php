<?php

namespace App\Services\Businesses\Handlers;

use App\Models\Business;
use App\Services\Businesses\DTOs\BusinessUpdateDTO;
use App\Services\Businesses\Repositories\BusinessRepositoryInterface;

/**
 * Редактирование данных салона
 * Class BusinessUpdateHandler
 * @package App\Services\Businesses\Handlers
 */
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
