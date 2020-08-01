<?php

namespace App\Services\Admin\Procedures\Handlers;

use App\Models\Procedure;
use App\Services\Admin\Procedures\Repositories\ProcedureRepositoryInterface;
use App\Services\Admin\Procedures\DTOs\ProcedureCreateDTO;

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
