<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
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

$factory->define(User::class, function (Faker $faker) {
    $email = $faker->unique()->safeEmail;
    $parts = explode('@', $email);
    $secondsInDay = 24 * 3600;
    $bdFrom = time() - $secondsInDay * 365 * 60;
    $bdTo = time() - $secondsInDay * 365 * 10;
    $sex = random_int(0, 1) ? 'male' : 'female';

    return [
        'name' => ($sex == 'male') ? $faker->firstNameMale : $faker->firstNameFemale,
        'surname' => $faker->lastName . (($sex == 'male') ? '' : 'а'),
        'email' => $email,
        'sex' => $sex,
        'phone'=> sprintf(
            "(%03d) %03d-%02d-%02d",
            random_int(901, 980),
            random_int(100, 999),
            random_int(0, 99),
            random_int(0, 99)
        ),
        'email_verified_at' => now(),
        'password' => Hash::make($parts[0]),
        'remember_token' => Str::random(10),
        'birthday' => Carbon::createFromTimestamp(random_int($bdFrom, $bdTo))
    ];
});
