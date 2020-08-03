<?php

namespace App\Services\Businesses\Handlers;

use App\Models\Business;
use App\Models\User;
use App\Services\Businesses\DTOs\BusinessCreateDTO;
use App\Services\Businesses\DTOs\BusinessHandlerDTO;
use App\Services\Businesses\Repositories\BusinessRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Добавление салона
 * Class BusinessCreateHandler
 * @package App\Services\Businesses\Handlers
 */
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
        $handlerDTO = BusinessHandlerDTO::fromArray(
            array_merge($businessDTO->toArray(), [
                'user_id' => Auth::user()->id
            ])
        );

        $business = $this->repository->create($handlerDTO);
        return $business;
    }
}
