<?php

use App\Model\User\Role;
use Illuminate\Database\Seeder;

/**
 * Class RoleSeeder
 *
 * Заполняет таблицу ролей
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stateList = ['admin', 'moderator', 'author'];
        foreach ($stateList as $state) {
            factory(Role::class)->state($state)->create();
        }
    }
}
