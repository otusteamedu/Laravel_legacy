<?php

namespace Tests\Generators;

use App\Models\Country;
use App\Models\Event;
use App\Models\EventType;
use App\Models\User;

class EventGenerator
{
    public static function createEventTraditional(array $data = []) {
        return self::createEvent(array_merge($data, []));
    }

    public static function createEvent(array $data = []) {
        return factory(Event::class)->create();
    }

    public static function generateEventCreateData(): array
    {
        $faker = \Faker\Factory::create();
        $data = factory(Event::class, 1)->make([])->first()->toArray();
        $data['is_solved'] = $faker->numberBetween(0, 1);

        return $data;
    }

    private static function initDependencies() {
        if ((EventType::all()->count() <= 0)) {
            \Artisan::call('db:seed', array('--class'=>'EventTypesTableSeeder'));
        }

        if ((User::all()->count() <= 0)) {
            \Artisan::call('db:seed', array('--class'=>'UserTableSeeder'));
        }

        if ((Country::all()->count() <= 0)) {
            \Artisan::call('db:seed', array('--class'=>'CountriesTableSeeder'));
        }
    }
}
