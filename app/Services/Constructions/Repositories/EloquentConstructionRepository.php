<?php


namespace App\Services\Constructions\Repositories;

use App\Models\Construction;
use Illuminate\Database\Eloquent\Builder;

class EloquentConstructionRepository implements ConstructionRepositoryInterface
{
    public function new()
    {
        return   new Construction();
    }

    public function find(int $id)
    {
        return Construction::find($id);
    }

    public function search(array $filters = [])
    {
        $query = Construction::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): Construction
    {
        $construction = new Construction();

        return $construction->create($data);
    }

    public function updateFromArray(Construction $construction, array $data)
    {
        $construction->update($data);
        return $construction;
    }

    public function getAllConstruction()
    {
        return Construction::All();
    }

    public function delete($id)
    {

        $langConstructor = Construction::find($id);
        $langConstructor->delete();

        return $id;
    }


    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
