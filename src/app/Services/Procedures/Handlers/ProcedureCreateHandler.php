<?php

namespace App\Services\Procedures\Handlers;

use App\Models\Procedure;
use App\Services\Procedures\DTOs\ProcedureHandlerDTO;
use App\Services\Procedures\Repositories\ProcedureRepositoryInterface;
use App\Services\Procedures\DTOs\ProcedureCreateDTO;
use Illuminate\Support\Facades\Auth;

/**
 * Добавление процедуры
 * Class ProcedureCreateHandler
 * @package App\Services\Procedures\Handlers
 */
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
        $handlerDTO = ProcedureHandlerDTO::fromArray(
            array_merge($DTO->toArray(), [
                'worker_id' => Auth::user()->id,
                'business_id' => Auth::user()->business->id
            ])
        );

        $procedure = $this->repository->create($handlerDTO);
        return $procedure;
    }
}
