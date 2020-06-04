<?php


namespace Tests\Generators;


use App\Models\Account;
use App\Models\User;

class AccountGenerator
{

    public static function createAccountAdminUser(array $data = [])
    {
        return self::createAccount(array_merge($data, [
            'level_access' => Account::LEVEL_ADMIN,
        ]));
    }

    public static function createAccountModeratorUser(array $data = [])
    {
        return self::createAccount(array_merge($data, [
            'level_access' => Account::LEVEL_MODERATOR,
        ]));
    }

    public static function createAccount(array $data = [])
    {
        return factory(Account::class)->create($data);
    }

}
