<?php
/**
 * Description of CurrencyGenerator.php
 */

namespace Tests\Generators;


use App\Models\Currency;

class CurrencyGenerator
{

    public static function createRub(array $data = [])
    {
        return self::createCurrency(array_merge($data, [
            'code' => 'RUB',
        ]));
    }

    public static function createUsd(array $data = [])
    {
        return self::createCurrency(array_merge($data, [
            'code' => 'USD',
        ]));
    }

    public static function createCurrency(array $data = []): Currency
    {
        return factory(Currency::class)->create($data);
    }

}
