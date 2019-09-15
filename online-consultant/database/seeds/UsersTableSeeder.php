<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Company::all() as $company) {
            factory(User::class, 2)->create([
                'company_id' => $company->id
            ]);
        }
    }
}
