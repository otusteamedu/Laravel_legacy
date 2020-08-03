<?php

namespace App\Services\Admin\BusinessTypes\Repositories;

use App\Models\BusinessType;
use App\Services\Admin\BusinessTypes\DTOs\BusinessTypeDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentBusinessTypeRepository implements BusinessTypeRepositoryInterface
{

    public function find(int $id): ?BusinessType
    {
        return BusinessType::find($id);
    }

    public function create(BusinessTypeDTO $DTO): ?BusinessType
    {
        return BusinessType::create($DTO->toArray());
    }

    public function get(): ?Collection
    {
        return BusinessType::all();
    }

    public function search(array $filter = [])
    {
        return BusinessType::paginate();
    }
}
