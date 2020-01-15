<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Operation;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Operation::class, function (Faker $faker) {
    return [
        'sum' => $faker->randomFloat(2, 50, 5000),
        'category_id' => factory(Category::class),
        'description' => $faker->text(50),
        'user_id' => factory(User::class),
        'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = 'UTC'),
    ];
});

$factory->state(Operation::class, 'type_income', [
    'sum' => 1000,
    'category_id' => 1,
    'user_id' => 1
]);

$factory->state(Operation::class, 'type_consumption', [
    'sum' => 1000,
    'category_id' => 2,
    'user_id' => 1
]);

$factory->state(Operation::class, 'yesterday', [
    'created_at' => Carbon::yesterday(),
    'updated_at' => Carbon::yesterday()
]);

$factory->state(Operation::class, 'week', [
    'created_at' => Carbon::today()->subWeek(),
    'updated_at' => Carbon::today()->subWeek()
]);

$factory->state(Operation::class, 'month', [
    'created_at' => Carbon::today()->subMonth(),
    'updated_at' => Carbon::today()->subMonth()
]);

$factory->state(Operation::class, 'quarter', [
    'created_at' => $dateStart = Carbon::today()->subMonth(3),
    'updated_at' => $dateStart = Carbon::today()->subMonth(3)
]);

$factory->state(Operation::class, 'year', [
    'created_at' => Carbon::today()->subYear(),
    'updated_at' => Carbon::today()->subYear()
]);




