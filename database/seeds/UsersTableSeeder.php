<?php

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
        foreach (\App\Models\User\Group::all() as $group) {
            factory(\App\Models\User\User::class, 5)->create([
                'group_id' => $group->id,
            ]);
        }
    }
}
