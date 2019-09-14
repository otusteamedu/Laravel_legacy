<?php

use App\Models\Company;
use App\Models\Widget;
use Illuminate\Database\Seeder;

class WidgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Company::all() as $company) {
            factory(Widget::class, 1)->create([
                'company_id' => $company->id
            ]);
        }
    }
}
