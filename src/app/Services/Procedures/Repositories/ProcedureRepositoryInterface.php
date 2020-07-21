<?php

namespace App\Services\Procedures\Repositories;

use App\Models\Procedure;
use App\Services\Procedures\DTOs\ProcedureCreateDTO;

interface ProcedureRepositoryInterface
{
    public function find(int $id): ?Procedure;
    public function create(ProcedureCreateDTO $DTO): ?Procedure;
    public function update(Procedure $procedure): Procedure;
    public function get();
    public function search(array $filter = []);
    public function delete(Procedure $procedure): bool;
}
