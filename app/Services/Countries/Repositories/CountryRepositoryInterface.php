<?php


namespace App\Services\Countries\Repositories;

use App\Models\Country;

interface CountryRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Country;

    public function updateFromArray(Country $country, array $data);
}
