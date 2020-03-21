<?php

namespace App\Services\Cities\Repositories;

use App\Models\City;

interface CityRepositoryInterface
{

    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): City;

    public function updateFromArray(City $city, array $data);

}
