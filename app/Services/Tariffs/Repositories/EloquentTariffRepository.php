<?php

namespace App\Services\Tariffs\Repositories;

use App\Models\Tariff;
use Illuminate\Database\Eloquent\Builder;

class EloquentTariffRepository implements TariffRepositoryInterface
{
    public function find(int $id)
    {
        return Tariff::find($id);
    }

    public function search(array $filters = [])
    {
        $query = Tariff::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): Tariff
    {
        $tariff = new Tariff();
        $tariff->create($data);
        return $tariff;
    }

    public function updateFromArray(Tariff $tariff, array $data)
    {
        $tariff->update($data);
        return $tariff;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
