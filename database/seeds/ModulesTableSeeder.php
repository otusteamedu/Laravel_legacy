<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $preInstalledModulesName = [
            [
                'code' => 'access',
                'sort' => 10,
                'name' => 'Пользователи и доступ'
            ], [
                'code' => 'movie',
                'sort' => 20,
                'name' => 'Справочник фильмов'
            ], [
                'code' => 'cinemas',
                'sort' => 30,
                'name' => 'Кинотеатры, залы, места'
            ], [
                'code' => 'sales',
                'sort' => 40,
                'name' => 'Продажи'
            ]
        ];

        foreach ($preInstalledModulesName as $moduleArray) {
            $module = new App\Models\Module();
            $module->create($moduleArray);
        }
    }
}
