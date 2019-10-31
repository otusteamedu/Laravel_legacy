<?php

use App\Models\Lead;
use App\Models\User;
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
        foreach (User::all() as $user) {
            factory(Lead::class, 5)->create([
                'created_user_id' => $user->id
            ]);
        }
    }
}
