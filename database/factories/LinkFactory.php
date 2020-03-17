<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Menu\Link;
use Faker\Generator as Faker;

$factory->define(
    Link::class,
    function (Faker $faker) {
        $routeList = ['main', 'personal', 'register', 'news'];
        $typeList = ['main', 'footer'];

        return [
            'route_name' => $faker->randomElement($routeList),
            'name' => $faker->name(),
            'type' => $faker->randomElement($typeList),
            'disabled' => $faker->boolean(10),
        ];
    }
);

$factory->state(Link::class, 'main', [
    'type' => 'main',
]);
$factory->state(Link::class, 'footer', [
    'type' => 'footer',
]);
