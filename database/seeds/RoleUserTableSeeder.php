<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            factory(RoleUser::class, 1)->create([
                'role_id' => Role::where(['name' => Role::AVAILABLE_SPEC_ROLE_LIST['moderators']])->first()->id,
                'user_id' => User::all()->random()->id,
            ]);
        }
    }
}
