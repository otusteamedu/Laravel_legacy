<?php

use Illuminate\Database\Seeder;
use App\Models\UserGroup;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            'Admin' => 'Администратор',
            'Guest' => 'Гость',
            'Registered' => 'Зарегистрированый',
            'Author' => 'Автор',
            'Blocked' => 'Заблокированный'
        ];

        foreach ($values as $name => $title) {
            $group = [
                'name' => $name,
                'title' => $title
            ];
            UserGroup::updateOrInsert(['name' => $name], $group);
        }
    }
}
