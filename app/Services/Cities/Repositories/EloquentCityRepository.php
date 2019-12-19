<?php
/**
 * Description of CityRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Cities\Repositories;


use App\Models\City;
use Illuminate\Database\Eloquent\Builder;

class EloquentCityRepository implements CityRepositoryInterface
{
    public function find(int $id)
    {
        return City::find($id);
    }

    public function search(array $filters = [])
    {
        $query = City::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): City
    {
        $city = new City();
        $city->create($data);
        return $city;
    }

    public function updateFromArray(City $city, array $data)
    {
        $city->update($data);
        return $city;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}