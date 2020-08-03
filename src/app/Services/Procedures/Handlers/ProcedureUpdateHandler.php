<?php

namespace App\Services\Procedures\Handlers;

use App\Models\Procedure;
use App\Services\Procedures\Repositories\ProcedureRepositoryInterface;
use App\Services\Procedures\DTOs\ProcedureCreateDTO;

class ProcedureUpdateHandler
{

    /**
     * @var ProcedureRepositoryInterface
     */
    private $repository;

    public function __construct(
        ProcedureRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(ProcedureCreateDTO $DTO, Procedure $procedure): Procedure
    {
        $procedure->setRawAttributes($DTO->toArray());
        return $this->repository->update($procedure);
    }
}
