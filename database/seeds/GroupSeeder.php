<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    private $groups = [
      ['name' => 'Администратор'],
      ['name' => 'Менеджер'],
      ['name' => 'Разработчик'],
      ['name' => 'Клиент'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->groups as $group) {
            (new \App\Models\Group($group))->save();
        }
    }
}
