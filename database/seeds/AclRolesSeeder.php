<?php

use Illuminate\Database\Seeder;

class AclRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intUserId = \App\Models\Acl\Role::create([
            'name' => 'blog.admin',
            'display_name' => 'Администратор блога',
            'description' => 'Администратор блога'
        ]);
    }
}
