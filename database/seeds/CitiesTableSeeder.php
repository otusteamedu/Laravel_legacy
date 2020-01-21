<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Country::all() as $country) {
            factory(\App\Models\City::class, 5)->create([
                'country_id' => $country->id,
            ]);
        }
    }
}
