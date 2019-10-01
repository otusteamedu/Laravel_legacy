<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SelectionMaterial;
use App\Models\User;
use Illuminate\Support\Str;
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

$factory->define(SelectionMaterial::class, function (Faker $faker) {

    $selectionMaterials = [
        'PHP для чайников',
        'laravel для чайников',
        'mysql для чайников',
        'грокаем алгоритмы',
    ];

    shuffle($selectionMaterials);
    $material = array_shift($selectionMaterials);

    return [
        'name' => $material,
    ];
});
