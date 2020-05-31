<?php


namespace App\Services\Towns\Repositories;


use App\Models\Town;

class EloquentTownRepository implements TownRepositoryInterface
{

    public function find(int $id)
    {
        return Town::find($id);
    }

    public function list()
    {
        return Town::all();
    }

    public function search(array $filters = [])
    {
        return Town::paginate();
    }

    public function createFromArray(array $data): Town
    {
        $town = new Town();
        $town->create($data);
        return $town;
    }

    public function updateFromArray(Town $town, array $data)
    {
        $town->update($data);
        return $town;
    }

    public function destroyFromObj(Town $town)
    {
        $town->delete();
    }
}
