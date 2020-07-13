<?php

namespace Tests\Generators;

use App\Models\Page;

class PageGenerator
{
    public static function createPage(array $data = []): Page
    {
        return factory(Page::class)->create($data);
    }
}