<?php

namespace App\Services\BusinessTypes\Repositories;

use App\Models\BusinessType;
use App\Services\BusinessTypes\DTOs\BusinessTypeDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentBusinessTypeRepository implements BusinessTypeRepositoryInterface
{
    public function get(): ?Collection
    {
        return BusinessType::all();
    }
}
