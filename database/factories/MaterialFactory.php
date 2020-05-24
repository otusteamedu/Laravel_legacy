<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Material;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    $material = $faker->word;
    return [
        'name' => $material,
        'name_ru' => $material . 'Ru'
    ];
});
