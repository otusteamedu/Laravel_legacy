<?php

namespace App\Services\OrderStatus\Repositories;

use App\Models\OrderStatus;
use App\Services\OrderStatus\Repositories\OrderStatusRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentOrderStatusRepository implements OrderStatusRepositoryInterface
{
    public function find(int $id): ?OrderStatus
    {
        return OrderStatus::find($id);
    }

    public function all(): Collection
    {
        return OrderStatus::all();
    }
}
