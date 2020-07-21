<?php

namespace App\Services\Businesses\Repositories;

use App\Models\Business;
use App\Services\Businesses\DTOs\BusinessCreateDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentBusinessRepository implements BusinessRepositoryInterface
{

    public function find(int $id): ?Business
    {
        return Business::find($id);
    }

    public function create(BusinessCreateDTO $registerDTO): ?Business
    {
        return Business::create($registerDTO->toArray());
    }

    public function update(Business $business): Business
    {
        $business->save();
        return $business;
    }

    public function get(): ?Collection
    {
        return Business::all();
    }

    public function search(array $filter = [])
    {
        return Business::paginate();
    }

    public function delete(Business $business): bool
    {
        return $business->delete();
    }
}
