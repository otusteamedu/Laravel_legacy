<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Menu\Menu;
use Faker\Generator as Faker;

$factory->define(
    Menu::class,
    function (Faker $faker) {
        $routeList = ['main', 'personal', 'register', 'news'];
        return [
            'route_name' => $faker->randomElement($routeList),
            'name' => $faker->name(),
            'disabled' => $faker->boolean(10),
        ];
    }
);
