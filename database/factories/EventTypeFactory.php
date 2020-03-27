<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EventType;
use Faker\Generator as Faker;

$factory->define(EventType::class, function (Faker $faker) {
    return [
        'name' => getUniqueEventTypeName($faker),
    ];
});

if (!function_exists('getUniqueEventTypeName')) {
    function getUniqueEventTypeName(Faker $faker)
    {
        $name = $faker->word();

        if (EventType::where('name', $name)->count()) {
            return getUniqueEventTypeName($faker);
        }

        return $name;
    }
}
