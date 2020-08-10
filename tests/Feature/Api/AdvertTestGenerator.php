<?php


namespace Tests\Feature\Api;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;

class AdvertTestGenerator
{

    public static function createAndAuthUser()
    {
        $user =  factory(User::class)->create();
        passport::actingAs($user);
    }

    public static function makeAndAuthUser()
    {
        $user =  factory(User::class)->make();
        passport::actingAs($user);
    }

    public static function generateAdvert()
    {
        return factory(Advert::class)->create();
    }

    public static function getExampleData(array $data=[]): array
    {
        return  array_merge([
            'division_id' => 1,
            'town_id' => 1,
            'title' => 'Sale - '.Str::random(5),
            'price' => 1000000,
            'content' => 'Good',

        ], $data);
    }

}
