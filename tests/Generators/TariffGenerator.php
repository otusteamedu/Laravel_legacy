<?php


namespace Tests\Generators;


use App\Models\Tariff;

/**
 * Class TariffGenerator
 * @package Tests\Generators
 */
class TariffGenerator
{
    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public static function createTariff (array $data = [])
    {
        return factory(Tariff::class)->create($data);
    }
}
