<?php


namespace App\Repositories\Countries;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface ICountryRepository
{
    public function find(int $id);
    public function search(array $filters = []) : Collection;
    public function createFromArray(array $data): Country;
    public function updateFromArray(Country $country, array $data);
    public function remove(Country $country);
}
