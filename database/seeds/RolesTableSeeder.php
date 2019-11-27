<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $preInstalledRolesName = [
            [
                'code' => 'root',
                'level' => 1000,
                'name' => 'Супер администратор'
            ], [
                'code' => 'admin',
                'level' => 100,
                'name' => 'Администратор'
            ], [
                'code' => 'content',
                'level' => 10,
                'name' => 'Контент-менеджеры'
            ], [
                'code' => 'operator',
                'level' => 10,
                'name' => 'Операторы'
            ], [
                'code' => 'registered',
                'level' => 1,
                'name' => 'Зарегистрированные пользователи'
            ]
        ];

        foreach ($preInstalledRolesName as $roleArray) {
            $role = new App\Models\Role();
            $role->create($roleArray);
        }
    }
}
