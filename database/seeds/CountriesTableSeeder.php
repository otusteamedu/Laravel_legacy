<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultCountryList = [
            [
                'name' => 'Россия',
                'phone_code' => '+7'
            ],
            [
                'name' => 'Україна',
                'phone_code' => '+38'
            ]
        ];

        foreach ($defaultCountryList as $country) {
            factory(Country::class, 1)->create(
                [
                    'name' => $country['name'],
                    'phone_code' => $country['phone_code'],
                ]
            );
        }
    }
}
