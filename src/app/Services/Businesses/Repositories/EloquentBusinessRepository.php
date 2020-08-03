<?php

namespace App\Services\Businesses\Repositories;

use App\Models\Business;
use App\Services\Businesses\DTOs\BusinessHandlerDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentBusinessRepository implements BusinessRepositoryInterface
{

//    public function find(int $id): ?Business
//    {
//        return Business::find($id);
//    }

    public function findByUserId(int $user_id): ?Business
    {
        return Business::whereUserId($user_id)->first();
    }

    public function create(BusinessHandlerDTO $registerDTO): ?Business
    {
        return Business::create($registerDTO->toArray());
    }

    public function update(Business $business): Business
    {
        $business->save();
        return $business;
    }

//    public function get(): ?Collection
//    {
//        return Business::all();
//    }
//
//    public function search(array $filter = [])
//    {
//        return Business::paginate();
//    }

    public function delete(Business $business): bool
    {
        return $business->delete();
    }
}
