<?php

use Illuminate\Database\Seeder;

class ShowingPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $tariffs = \App\Models\Tariff::orderBy('id', 'asc')->get()->all();
        $movieShowings = \App\Models\MovieShowing::orderBy('id', 'asc')->get()->all();

        foreach ($movieShowings as $movieShowing) {
            $basePrice = random_int(150, 300);
            /** @var \App\Models\Tariff $tariff */
            foreach ($tariffs as $tariff) {
                $model = new \App\Models\ShowingPrice;
                $model->movieShowing()->associate($movieShowing);
                $model->tariff()->associate($tariff);

                $model->value = $basePrice * $tariff->defaultKoef;
                $model->save();
            }
        }
    }
}
