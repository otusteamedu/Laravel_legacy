<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    $currentRoleName = getCurrentRoleName();
    return [
        'name' => $currentRoleName,
    ];
});

if (!function_exists('getCurrentRoleName')) {
    function getCurrentRoleName() {
        return Role::ROLES_AVAILABLE_NAME_LIST[array_rand(Role::ROLES_AVAILABLE_NAME_LIST)];
    }
}
