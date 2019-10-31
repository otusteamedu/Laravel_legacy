<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            factory(Company::class, 1)->create([
                'created_user_id' => $user->id
            ]);
        }
    }
}
