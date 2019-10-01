<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Handbook;
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

$factory->define(Handbook::class, function (Faker $faker) {

    $names = [
        'publish' => 'опибликовано',
        'reject' => 'отклонено',
        'moderation' => 'на модерации',
        'paper' => 'Бумага',
        'audio' => 'Аудио',
        'e-book' => 'Электронная книга',

    ];

    $statusMap = [
        'MaterialStatus' => [
            'publish',
            'reject',
            'moderation'
        ],
        'MaterialFormat' => [
            'paper',
            'audio',
            'e-book'
        ],
    ];

    $code = $faker->randomElement(array_keys($statusMap));
    $value = $faker->randomElement($statusMap[$code]);

    return [
        'code' => $code,
        'name' => $names[$value],
        'description' => $faker->text
    ];
});
