<?php

namespace App\Services\Procedures\Handlers;

use App\Models\Procedure;
use App\Services\Procedures\Repositories\ProcedureRepositoryInterface;
use App\Services\Procedures\DTOs\ProcedureCreateDTO;

class ProcedureDeleteHandler
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

    public function handle(Procedure $procedure): bool
    {
        return $this->repository->delete($procedure);
    }
}
