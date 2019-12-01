<?php


namespace Tests\Generators;

use App\Models\User;

class UserGenerator {

    public static function createAdminUser(array $data = []) {
        return self::createUser(array_merge($data, [
            'role' => User::ADMIN_ROLE
        ]));
    }

    public static function createEditorUser(array $data = []) {
        return self::createUser(array_merge($data, [
            'role' => User::EDITOR_ROLE
        ]));
    }

    public static function createSimpleUser(array $data = []) {
        return self::createUser(array_merge($data, [
            'role' => null
        ]));
    }

    public static function createUser(array $data = []) {
       return factory(User::class)->create($data);
    }
}
