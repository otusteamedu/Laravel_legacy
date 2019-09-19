<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    protected $roles = [
        'Administrator',
        'User',
        'Moderator',
        'Guest'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            Role::query()->create([
                'name' => $role
            ]);
        }
    }
}
