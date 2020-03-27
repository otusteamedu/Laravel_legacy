<?php

namespace Tests\Generators;

use App\Models\Article;

class ArticleGenerator
{
    public static function createArticleTutorial(array $data = []) {
        $data['name'] = 'Tutorial for test';

        return self::createArticle(array_merge($data, []));
    }

    public static function createArticle(array $data = []) {
        if (isset($data['name'])) {
            $data['name'] = 'Test article. ' . $data['name'];
        } else {
            $data['name'] = 'Test article';
        }

        return factory(Article::class)->create($data);
    }
}
