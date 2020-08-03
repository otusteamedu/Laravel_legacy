<?php

namespace App\Services\Procedures\Repositories;

use App\Models\Procedure;
use App\Services\Procedures\DTOs\ProcedureHandlerDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentProcedureRepository implements ProcedureRepositoryInterface
{

    public function find(int $id): ?Procedure
    {
        return Procedure::find($id);
    }

    public function findByBusinessId(int $business_id): ?Collection
    {
        return Procedure::whereBusinessId($business_id)->get();
    }

    public function create(ProcedureHandlerDTO $DTO): ?Procedure
    {
        return Procedure::create($DTO->toArray());
    }

    public function get(): ?Collection
    {
        return Procedure::all();
    }

    public function search(array $filter = [])
    {
        return Procedure::paginate();
    }

    public function update(Procedure $procedure): Procedure
    {
        $procedure->save();
        return $procedure;
    }

    public function delete(Procedure $procedure): bool
    {
        return $procedure->delete();
    }
}
