<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\User\Role;
use Faker\Generator as Faker;

$factory->define(
    Role::class,
    function (Faker $faker) {
        return [
            'name' => $faker->word(),
            'code' => $faker->unique()->domainWord,
        ];
    }
);
$factory->state(Role::class, 'admin', [
    'code' => 'admin',
]);
$factory->state(Role::class, 'moderator', [
    'code' => 'moderator',
]);
$factory->state(Role::class, 'author', [
    'code' => 'author',
]);
