<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Company::all() as $company) {
            factory(\App\Models\Product::class, 5)->create([
                'company_id' => $company->id,
            ]);
        }
    }
}
