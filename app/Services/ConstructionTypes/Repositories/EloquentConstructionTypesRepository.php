<?php


namespace App\Services\ConstructionTypes\Repositories;


use App\Models\ConstructionType;
use Illuminate\Database\Eloquent\Builder;

class EloquentConstructionTypesRepository implements ConstructionTypesRepositoryInterface
{
    public function new()
    {
        return   new ConstructionType();
    }

    public function find(int $id)
    {
        return ConstructionType::find($id);
    }

    public function search(array $filters = [])
    {
        $query = ConstructionType::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): ConstructionType
    {
        $construction = new ConstructionType();
        $construction ->create($data);
        return $construction;
    }

    public function updateFromArray(ConstructionType $construction, array $data)
    {
        $construction->update($data);
        return $construction;
    }

    public function getAllConstructionTypes()
    {
        return ConstructionType::All();
    }

    public function delete($id)
    {

        $langConstructor = ConstructionType::find($id);
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
