<?php

declare(strict_types=1);

namespace App\Services\Location\Repositories;

use App\Services\Location\Interfaces\LocationRepositoryInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationRepositoryInterface {

    /**
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @param  array  $filters
     * @param  string  $path
     * @return Location|Collection|static[]|static|null
     *
     * @todo Использовать $filters
     */
    public function search(array $conditions = [], array $filters = [], string $path = '')
    {
        $result = Location::where($conditions)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate();
        if ($path !== '') {
            $result->withPath($path);
        }
        return $result;
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Location|Collection|static[]|static|null
     */
    public function findById(int $id)
    {
        return Location::find($id);
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return Location|static
     */
    public function create(array $data)
    {
        return Location::create($data);
    }

    /**
     * Update a record and fill it with values.
     *
     * @param  Location  $location
     * @param  array  $data
     * @return Location|static
     */
    public function update(Location $location, array $data)
    {
        $location->update($data);
        return $location;
    }

    /**
     * Delete a record from the database.
     *
     * @param  Location  $location
     * @return mixed
     * @throws \Exception
     */
    public function delete(Location $location)
    {
        return $location->delete();
    }

}
