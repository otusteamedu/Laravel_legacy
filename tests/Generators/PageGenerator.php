<?php

namespace Tests\Generators;

use App\Models\Page;

class PageGenerator
{

    /* public static function createRussia(array $data = [])
    {
    return self::createCountry(array_merge($data, [
    'name' => 'Russia',
    'continent_name' => 'Europe',
    ]));
    }
     */

    public static function createPage(array $data = []): Film
    {
        return factory(Page::class)->create($data);
    }
}