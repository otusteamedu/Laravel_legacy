<?php

namespace Tests\Generators;

use App\Models\News;

class NewsGenerator
{
    public static function createNewsTutorial(array $data = []) {
        $data['name'] = 'Tutorial for test';

        return self::createNews(array_merge($data, []));
    }

    public static function createNews(array $data = []) {
        if (isset($data['name'])) {
            $data['name'] = 'Test news. ' . $data['name'];
        } else {
            $data['name'] = 'Test news';
        }

        return factory(News::class)->create($data);
    }
}
