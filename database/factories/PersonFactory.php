<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Person::class, function (Faker $faker) {
    $sex = random_int(0, 1) ? 'male' : 'female';
    $name = ($sex == 'male') ? $faker->firstNameMale : $faker->firstNameFemale;
    $surname = $faker->lastName . (($sex == 'male') ? '' : 'а');

    $secondsInDay = 24 * 3600;
    $bdFrom = time() - $secondsInDay * 365 * 70;
    $bdTo = time() - $secondsInDay * 365 * 15;

    return [
        'name' => sprintf("%s %s", $surname, $name),
        'birth_day' => Carbon::createFromTimestamp(random_int($bdFrom, $bdTo)),
        'sex' => $sex,
        'description' => $faker->text(500)
    ];
});
