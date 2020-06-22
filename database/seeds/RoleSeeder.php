<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            Role::STUDENT => 'student',
            Role::TEACHER => 'teacher',
            Role::ADMIN => 'admin',
            Role::METHODIST => 'methodist',
        ];

        foreach ($roles as $id => $role) {
            Role::firstOrCreate([
                'id' => $id,
                'name' => $role,
            ]);
        }
    }
}
