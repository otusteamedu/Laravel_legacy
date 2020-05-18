<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Filter;
use Faker\Generator as Faker;

$factory->define(Filter::class, function (Faker $faker) {

    $created = $faker->dateTimeBetween('-2 months', '-1 days');
    $value = rand(16, 25) . '-' . rand(26, 65);
    $name = 'Age ' . $value;
//    $name = 'Age';
    $data = [
        'filter_type_id' => rand(1, 10),
        'quota_id' => rand(1, 2),
        'name' => $name,
        'value' => $value,
        'description' => $faker->word(),
        'created_at' => $created,
        'updated_at' => $created,
        'created_user_id' => rand(1,3),
    ];
    return $data;

});
