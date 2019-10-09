<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Compilation;
use App\Models\Handbook;
use App\Models\Journal;
use App\Models\Material;
use App\Models\ReadMaterial;
use App\Models\Review;
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

$factory->define(Compilation::class, function (Faker $faker) {
    return [
        'material_id' => function () {
            return factory(Material::class)->create()->id;
        },
        'compilation_id' => function () {
            return factory(SelectionMaterial::class)->create()->id;
        },
    ];
});
