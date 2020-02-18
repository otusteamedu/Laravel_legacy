<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Picture;
use Faker\Generator as Faker;

$factory->define(Picture::class, function (Faker $faker) {
    $pictureList = [
        'https://pbs.twimg.com/profile_images/521683642070749184/o0Qs8JkQ.jpeg',
        'https://avatarfiles.alphacoders.com/159/159520.png',
        'https://avatarfiles.alphacoders.com/194/194973.jpg',
        'https://img2.freepng.ru/20180521/ocp/kisspng-computer-icons-user-profile-avatar-french-people-5b0365e4f1ce65.9760504415269493489905.jpg',
        'https://img.favpng.com/10/23/1/computer-icons-user-profile-avatar-png-favpng-ypy9BWih5X28x0zDEBeemwyx8.jpg',
        'https://f0.pngfuel.com/png/136/22/profile-icon-illustration-user-profile-computer-icons-girl-customer-avatar-png-clip-art-thumbnail.png',
        'https://img.favpng.com/8/0/5/computer-icons-user-profile-avatar-png-favpng-6jJk1WU2YkTBLjFs4ZwueE8Ub.jpg'
    ];
    return [
        'path' => $pictureList[rand(0, count($pictureList) - 1)]
    ];
});
