<?php


namespace App\Services\Divisions\Repositories;


use App\Models\Division;

class EloquentDivisionRepository implements DivisionRepositoryInterface
{

    public function find(int $id)
    {
        return Division::find($id);
    }

    public function list()
    {
        return Division::all();
    }

    public function search(array $filters = [])
    {
        return Division::paginate();
    }

    public function createFromArray(array $data): Division
    {
        $division = new Division();
        $division->create($data);
        return $division;
    }

    public function updateFromArray(Division $division, array $data)
    {
        $division->update($data);
        return $division;
    }

    public function destroyFromObj(Division $division)
    {
        $division->delete();
    }
}
