<?php

namespace App\Services\Admin\Procedures\Handlers;

use App\Models\Procedure;
use App\Services\Admin\Procedures\Repositories\ProcedureRepositoryInterface;
use App\Services\Admin\Procedures\DTOs\ProcedureCreateDTO;

class ProcedureCreateHandler
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

    public function handle(ProcedureCreateDTO $DTO): Procedure
    {
        $procedure = $this->repository->create($DTO);
        return $procedure;
    }
}
