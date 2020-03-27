<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => getUniqueRoleName($faker)
    ];
});

if (!function_exists('getUniqueRoleName')) {
    function getUniqueRoleName(Faker $faker)
    {
        $name = $faker->word();

        if (Role::where('name', $name)->count()) {
            return getUniqueRoleName($faker);
        }

        return $name;
    }
}
