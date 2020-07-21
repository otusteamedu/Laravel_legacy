<?php

namespace App\Services\Procedures\Repositories;

use App\Models\Procedure;
use App\Services\Procedures\DTOs\ProcedureCreateDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentProcedureRepository implements ProcedureRepositoryInterface
{

    public function find(int $id): ?Procedure
    {
        return Procedure::find($id);
    }

    public function create(ProcedureCreateDTO $DTO): ?Procedure
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
