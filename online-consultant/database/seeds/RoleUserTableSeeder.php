<?php

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            factory(RoleUser::class, 1)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
