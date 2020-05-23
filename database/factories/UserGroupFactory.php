<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserGroup;
use Faker\Generator as Faker;

$factory->define(UserGroup::class, function (Faker $faker) {

    $names = ['Admin', 'Guest', 'Registered'];
    $name = $names[array_rand($names)];
    if (UserGroup::where('name', $name)->get())
        return [
            'name' => $name
        ];
});
