<?php
use Illuminate\Support\Str;
$faker = Faker\Factory::create('ru_RU');

$recipe['image'] = '/images/1.jpg';
$recipe['date'] = 'Last updated 3 mins ago';
$recipe['title'] = $faker->realText(rand(30, 50));
$recipe['author']['name'] = $faker->firstNameMale;
$recipe['author']['slug'] = Str::slug($recipe['author']['name']);
$recipe['products']['text'] = 'Картошка, морковка, соль, перец';
$recipe['products']['array'] = [['name' => 'мука', 'slug' => 'slugss'], ['name' => 'рыба', 'slug' => 'slugss'], ['name' => 'тесто', 'slug' => 'slugss']];
$recipe['products'] = $faker->randomElement([$recipe['products']['text'], $recipe['products']['array']]);
$recipe['short-description'] = $faker->realText(250);
$recipe['full-description'] = $faker->realText(250);
$recipe['count']['like'] = rand(1, 1000);
$recipe['count']['comments'] = rand(1, 1000);
$recipe['published'] = rand(1, 0);
$recipe['kitchen']['value'] = $faker->randomElement(['Украинская', null]);
$recipe['kitchen']['slug'] = $recipe['kitchen']['value'] ? Str::slug($recipe['kitchen']['value']) : null;
$recipe['slug'] = Str::slug($recipe['title']);
$recipe['steps'] = array_fill(1, rand(1, 7), []);
$recipe['comments'] = array_fill(1, rand(1, 7), []);
$recipe['comments'] = array_map(function ($item) use ($faker) {
    $user['name'] = $faker->firstNameMale;
    $user['slug'] = Str::slug($user['name']);
    return [
        'date' => '12.12.12',
        'text' => $faker->realText(rand(5, 200)),
        'user' => [
            'name' => $user['name'],
            'slug' => $user['slug'],
            'photo' => '/images/1.jpg']
    ];
}, $recipe['comments']);
$recipe['author']['slug'] = Str::slug($recipe['author']['name']);

$recipes = array_fill(1, 5, $recipe);

$author['name'] = $faker->firstNameMale;
$author['slug'] = Str::slug($author['name']);
$author['image'] = '/images/1.jpg';
$author['photo'] = '/images/1.jpg';
$author['about'] = $faker->realText(rand(130, 350));;
$author['count']['recipes'] = rand(1,1000);
$author['count']['comments'] =rand(1,1000);
$author['count']['subscribers'] =rand(1,1000);
$author['count']['like'] =rand(1,1000);
$author['rating'] = rand(1, 1000);
$ratings['authors'] = array_fill(1, 100, $author);;


