<?php

use Illuminate\Database\Seeder;

class ModAccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $preInstalledModAccessesName = [
            'access' => [
                [
                    'code' => 'D',
                    'sort' => 10,
                    'name' => 'Доступ закрыт'
                ], [
                    'code' => 'R',
                    'sort' => 20,
                    'name' => 'Просмотр пользователей'
                ], [
                    'code' => 'U',
                    'sort' => 30,
                    'name' => 'Изменение/удаление пользователей'
                ], [
                    'code' => 'Z',
                    'sort' => 40,
                    'name' => 'Полный доступ (изм.прав)'
                ]
            ],
            'movie' => [
                [
                    'code' => 'D',
                    'sort' => 10,
                    'name' => 'Доступ закрыт'
                ], [
                    'code' => 'R',
                    'sort' => 20,
                    'name' => 'Просмотр справочников'
                ], [
                    'code' => 'U',
                    'sort' => 30,
                    'name' => 'Добавление/изменение+удаление своих записей'
                ], [
                    'code' => 'Z',
                    'sort' => 40,
                    'name' => 'Полный доступ'
                ]
            ],
            'cinemas' => [
                [
                    'code' => 'D',
                    'sort' => 10,
                    'name' => 'Доступ закрыт'
                ], [
                    'code' => 'R',
                    'sort' => 20,
                    'name' => 'Просмотр объектов'
                ], [
                    'code' => 'U',
                    'sort' => 30,
                    'name' => 'Управление объектами'
                ], [
                    'code' => 'X',
                    'sort' => 40,
                    'name' => 'Управление сеансами'
                ], [
                    'code' => 'Z',
                    'sort' => 50,
                    'name' => 'Полный доступ'
                ]
            ],
            'sales' => [
                [
                    'code' => 'D',
                    'sort' => 10,
                    'name' => 'Доступ закрыт'
                ], [
                    'code' => 'R',
                    'sort' => 20,
                    'name' => 'Просмотр заказов'
                ], [
                    'code' => 'U',
                    'sort' => 30,
                    'name' => 'Управление заказами'
                ], [
                    'code' => 'Z',
                    'sort' => 40,
                    'name' => 'Полный доступ'
                ]
            ]
        ];

        $modules = \App\Models\Module::all();
        /** @var \App\Models\Module $module */
        foreach ($modules as $module) {
            $key = $module->code;
            if(array_key_exists($key, $preInstalledModAccessesName)) {
                foreach ($preInstalledModAccessesName[$key] as $access) {
                    $modAccess = new \App\Models\ModAccess();
                    $modAccess->fill($access);
                    $modAccess->module()->associate($module);

                    $modAccess->save();
                }
            }
        }
    }
}
