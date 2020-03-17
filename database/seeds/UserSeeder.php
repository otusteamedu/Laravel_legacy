<?php

use App\Model\User\Role;
use App\Model\User\User;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 *
 * Заполняет таблицу пользователей
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        foreach (Role::all() as $role) {
            $users = factory(User::class, random_int(3, 6))->create();

            foreach ($users as $user) {
                $user->roles()->attach($role->id);
            }
        }
    }
}
