<?php

use Illuminate\Database\Seeder;

class TariffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $preInstalledTariffName = [
            [
                'defaultKoef' => 1,
                'name' => 'Эконом'
            ], [
                'defaultKoef' => 1.25,
                'name' => 'Стандарт'
            ], [
                'defaultKoef' => 1.5,
                'name' => 'VIP'
            ]
        ];

        \App\Models\Tariff::reguard();
        foreach ($preInstalledTariffName as $tariffArray) {
            $tariff = new App\Models\Tariff();
            $tariff->create($tariffArray);
        }
    }
}
