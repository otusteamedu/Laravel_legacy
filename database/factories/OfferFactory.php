<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Offer;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'name' => 'Скидка ' . $faker->numberBetween(5,50) . '%',
        'description' => 'Условия акции: '. \n . $faker->text,
        'expiration_date' => $faker->dateTime,
        'project_id' => function(){
            return factory(App\Models\Project::class)->create()->id;
        },
        'city_id' => function(){
            return factory(App\Models\City::class)->create()->id;
        },
        'lat' => $faker->latitude,
        'lon' => $faker->longitude,
        'created_at' => now(),
    ];
});
