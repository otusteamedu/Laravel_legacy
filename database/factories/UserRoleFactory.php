<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\RoleUser;
use Faker\Generator as Faker;

$factory->define(RoleUser::class, function (Faker $faker) {

    $userId = $faker->unique()->numberBetween(1, 50);
    $roleId = $faker->numberBetween(1, 8);

    return [
        'user_id' => $userId,
        'role_id' => $roleId,
    ];
});
