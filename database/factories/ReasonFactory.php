<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reason;
use Faker\Generator as Faker;

$factory->define(Reason::class, function (Faker $faker) {

    $name = $faker->sentence($nbWords = rand(1, 3), $variableNbWords = true);
    $description = $faker->text(250);
    $amount = $faker->numberBetween(0.5, 50)*100;

    return [
        'name' => $name,
        'description'=>$description,
        'amount'=>$amount,
    ];
});
