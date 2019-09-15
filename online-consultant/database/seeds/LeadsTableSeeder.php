<?php

use App\Models\Company;
use App\Models\Lead;
use Illuminate\Database\Seeder;

class LeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Company::all() as $company) {
            factory(Lead::class, 5)->create([
                'company_id' => $company->id
            ]);
        }
    }
}
