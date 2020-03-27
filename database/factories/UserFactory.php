<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Country;
use App\Models\Picture;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'active' => $faker->numberBetween(0, 1),
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'country_id' => factory(Country::class, 1)->create()->first()->id,
        'region' => $faker->state,
        'locality' => $faker->city,
        'email' => getUniqueUserEmail($faker),
        'email_verified_at' => now(),
        'phone' => getUniqueUserPhone($faker),
        'password' => md5(rand()),
        'picture_id' => factory(Picture::class, 1)->create([])->first()->id,
        'api_token' => Str::random(60),
    ];
});

if (!function_exists('getUniqueUserEmail')) {
    function getUniqueUserEmail(Faker $faker)
    {
        $email = $faker->safeEmail;

        if (User::where('email', $email)->count()) {
            return getUniqueUserEmail($faker);
        }

        return $email;
    }
}

if (!function_exists('getUniqueUserPhone')) {
    function getUniqueUserPhone(Faker $faker)
    {
        $phone = $faker->phoneNumber;

        if (User::where('phone', $phone)->count()) {
            return getUniqueUserPhone($faker);
        }

        return $phone;
    }
}
