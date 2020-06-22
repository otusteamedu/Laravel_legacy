<?php

namespace App\Services\OrderStatus\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\OrderStatus;

interface OrderStatusRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?OrderStatus;
}
