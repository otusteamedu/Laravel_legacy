<?php

use Illuminate\Database\Seeder;
use \App\Models\Acl\Role;

class AclRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intUserId = Role::create([
            'name' => 'blog.admin',
            'display_name' => 'Администратор блога',
            'description' => 'Администратор блога'
        ]);
    }
}
