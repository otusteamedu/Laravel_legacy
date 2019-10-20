<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    protected $roles = [
        'Administrator', //администратор
        'Supervisor', //руководитель
        'Bookkeeper', //бухгалтер
        'Cashier', //кассир
        'Landowner', //владелец учатска
        'Guest', //гость
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            Role::query()->create([
                'name' => $role,
            ]);
        }
    }
}
