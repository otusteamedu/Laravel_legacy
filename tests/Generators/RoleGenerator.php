<?php

namespace Tests\Generators;

use App\Models\Country;
use App\Models\Role;

class RoleGenerator
{
    public static function createRoleRussian(array $data = []) {
        $countryRussia = CountryGenerator::getCountryRussia();

        if (empty($countryRussia)) {
            $countryRussia = CountryGenerator::createCountryRussia();
        }

        $data['name'] = 'русский';
        $data['code'] = 'rus';
        $data['country_id'] = $countryRussia->get->id;

        return self::createRole(array_merge($data, []));
    }

    public static function createRoleUkrainian(array $data = []) {
        $data['name'] = 'українська';
        $data['code'] = 'ukr';
        $data['country_id'] = Country::where('phone_code', '+38')->value('id');

        return self::createRole(array_merge($data, []));
    }

    public static function createRole(array $data = []) {
        return factory(Role::class)->create($data);
    }

    public static function generateRoleCreateData(): array
    {
        return factory(Role::class)->make()->getAttributes();
    }
}
