<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected $permissions = [
        'Personal Account Management', //управление лицевыми счетами
        'Posting payments', // разноска платежей
        'View reports', //просмотр отчетов
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach ($this->permissions as $permission) {
            Permission::query()->create([
                'name' => $permission,
            ]);
        }
    }
}
