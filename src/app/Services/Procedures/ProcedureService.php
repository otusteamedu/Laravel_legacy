<?php

namespace App\Services\Procedures;

use App\Models\Procedure;
use App\Services\Procedures\DTOs\ProcedureCreateDTO;
use App\Services\Procedures\DTOs\ProcedureUpdateDTO;
use App\Services\Procedures\Handlers\ProcedureCreateHandler;
use App\Services\Procedures\Handlers\ProcedureDeleteHandler;
use App\Services\Procedures\Handlers\ProcedureUpdateHandler;
use App\Services\Procedures\Repositories\ProcedureRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProcedureService
{

    /**
     * @var ProcedureCreateHandler
     */
    private $createHandler;
    /**
     * @var ProcedureRepositoryInterface
     */
    private $repository;
    /**
     * @var ProcedureUpdateHandler
     */
    private $updateHandler;

    public function __construct(
        ProcedureCreateHandler $createHandler,
        ProcedureUpdateHandler $updateHandler,
        ProcedureRepositoryInterface $repository
    ) {
        $this->createHandler = $createHandler;
        $this->repository = $repository;
        $this->updateHandler = $updateHandler;
    }

    /**
     * Добавить запись
     * @param array $data
     * @return Procedure
     */
    public function create(array $data): Procedure
    {
        $type = ProcedureCreateDTO::fromArray($data);

        return $this->createHandler->handle($type);
    }

    /**
     * Обновить запись
     * @param array $data
     * @param Procedure $procedure
     */
    public function update(array $data, Procedure $procedure)
    {
        $DTO = ProcedureUpdateDTO::fromArray($data);
        $this->updateHandler->handle($DTO, $procedure);
    }

    /**
     * Удалить запись
     * @param Procedure $procedure
     */
    public function delete(Procedure $procedure)
    {
        (new ProcedureDeleteHandler($this->repository))->handle($procedure);
    }

    /**
     * Списк всех типов
     * @return Collection|null
     */
    public function list(): ?Collection
    {
        return $this->repository->get();
    }
}
