<?php
/**
 * Description of CountryRepositoryInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Cities\Repositories;


use App\Models\City;

interface CityRepositoryInterface
{
    public function find(int $id);

    public function getBy(array $filters = [], array $with = []);

    public function search(array $filters = [], array $with = []);

    public function createFromArray(array $data): City;

    public function updateFromArray(City $city, array $data);
}