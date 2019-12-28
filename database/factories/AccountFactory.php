<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'user_id'=>1,
        'source'=>'',
        'login'=>$faker->word,
        'password'=>'test',
        'cum_sum'=>0,
        'discount_coefficient'=>Account::DISCOUNT_COEFFICIENT_MIN
    ];
});
