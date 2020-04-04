<?php

use Illuminate\Database\Seeder;
use App\Models\Acl\Permission;
use App\Models\Acl\Role;

class AclPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'blog.admin')->first();

        // Категорий
        $role->permissions()->attach($permission = Permission::create([
            'name' => 'blog.category.edit',
            'scope' => 'blog',
            'display_name' => 'Редактирование категорий блога',
            'description' => 'Доступ на создание, редактирование всех категорий блога'
        ])->id);

        // Статьи
        $role->permissions()->attach($permission = Permission::create([
            'name' => 'blog.article.edit',
            'scope' => 'blog',
            'display_name' => 'Редактирование статьи',
            'description' => 'Доступ на создание, редактирование всех статей блога'
        ])->id);

        // Автора
        $role->permissions()->attach($permission = Permission::create([
            'name' => 'blog.author.edit',
            'scope' => 'blog',
            'display_name' => 'Редактирование авторов',
            'description' => 'Доступ на создание, редактирование всех авторов блога'
        ])->id);

    }
}
