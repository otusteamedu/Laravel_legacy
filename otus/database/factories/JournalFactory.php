<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Handbook;
use App\Models\Journal;
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

$factory->define(Journal::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },

        'status_id' => function () {
            return factory(Handbook::class)->create()->id;
        }
    ];
});
