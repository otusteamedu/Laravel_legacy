<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    $name = uniqueCompany($faker);
    return [
        'name' => $name,
        'url' => Str::slug($name),
        'description' => '',
    ];
});

if (!function_exists('uniqueCompany')) {

    function uniqueCompany(Faker $faker)
    {
        $name = $faker->unique()->company;
        if (\App\Models\Company::where('name', $name)->count()) {
            return uniqueCompany($faker);
        }
        return $name;
    }
}
