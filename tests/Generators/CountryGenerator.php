<?php


namespace Tests\Generators;


use App\Models\Country;

class CountryGenerator
{
    public function createCountry (array $data = [])
    {
        return factory(Country::class)->create($data);
    }

}
