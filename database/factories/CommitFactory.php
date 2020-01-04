<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use \Illuminate\Support\Str;
use App\Models\Commit;
use App\Models\Repository;
use Faker\Generator as Faker;

$factory->define(Commit::class, function (Faker $faker) {
    return [
        'hash' => Str::random(40),
        'author' => $faker->firstName . ' ' . $faker->lastName,
        'commit_datetime' => $faker->dateTimeBetween('-1 year', 'now'),
        'summary' => $faker->sentence,
        'repository_id' => factory(Repository::class),
    ];
});
