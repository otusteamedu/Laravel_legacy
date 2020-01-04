<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Helpers\UrlHelpers;
use App\Models\Repository;
use App\ValueObjects\RepositoryUrl;
use Faker\Generator as Faker;

$factory->define(Repository::class, function (Faker $faker) {
    $url = new RepositoryUrl('https://github.com/' . $faker->word . '/' . $faker->word);
    return [
        'url' => $url->url(),
        'normalized_url' => $url->normalizedUrl(),
    ];
});
