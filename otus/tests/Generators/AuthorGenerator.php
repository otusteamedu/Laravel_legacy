<?php

namespace Tests\Generators;

use App\Models\Author;

class AuthorGenerator {

    public static function createUncleBob(array $data = []) {
        return self::createAuthor(array_merge([
            'name' => 'Uncle Bob',
        ], $data));
    }

    public static function createMax(array $data = []) {
        return self::createAuthor(array_merge([
            'name' => 'Max Folder',
        ], $data));
    }

    public static function createAuthor(array $data = []) {
        return factory(Author::class)->create($data);
    }
}
