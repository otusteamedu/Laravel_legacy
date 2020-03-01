<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
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

$factory->define(Category::class, function (Faker $faker) {
    $categories = [
        'Одежда',
        'Продукты питания',
        'Мебель',
        'Путешествия',
        'Услуги',
    ];
    shuffle($categories);
    $category = array_shift($categories);
    return [
        'name' => $category,
        'description' => $faker->text,
        'created_at' => now(),
    ];
});
