<?php

namespace App\Services\Procedures\Repositories;

use App\Models\Procedure;
use App\Services\Procedures\DTOs\ProcedureHandlerDTO;
use Illuminate\Database\Eloquent\Collection;

interface ProcedureRepositoryInterface
{
    public function find(int $id): ?Procedure;
    public function findByBusinessId(int $business_id): ?Collection;
    public function create(ProcedureHandlerDTO $DTO): ?Procedure;
    public function update(Procedure $procedure): Procedure;
    public function get();
    public function search(array $filter = []);
    public function delete(Procedure $procedure): bool;
}
