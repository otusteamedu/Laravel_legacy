<?php


namespace App\Repositories\Countries;


use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository implements ICountryRepository
{
    public function find(int $id)
    {
        return Country::find($id);
    }
    public function search(array $filters = []): Collection
    {
        //return Country::paginate();
        return Country::all();
    }
    public function createFromArray(array $data): Country
    {
        $country = new Country();
        $country->create($data);
        return $country;
    }
    public function updateFromArray(Country $country, array $data)
    {
        $country->update($data);
        return $country;
    }
    public function remove(Country $country) {
        $country->delete();
    }
}
