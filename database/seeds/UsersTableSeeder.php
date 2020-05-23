<?php

use Illuminate\Database\Seeder;
use App\Models\UserGroup;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Для каждой группы создаем по 10 пользователей
     *
     * @return void
     */
    public function run()
    {
        foreach (UserGroup::all() as $group) {
            factory(\App\Models\User::class, 10)->create(['group_id' => $group->id]);
        }
    }
}
