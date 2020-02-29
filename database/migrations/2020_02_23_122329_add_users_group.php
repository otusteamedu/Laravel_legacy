<?php

use App\Models\User\Group;
use App\Models\User\Right;
use Illuminate\Database\Migrations\Migration;

/**
 * Добавляем группы
 * Class AddUsersGroup
 */
class AddUsersGroup extends Migration
{
    protected const USER_GROUPS = [
        [
            'name' => 'Авторизованный пользователь',
            'rights' => [],
        ],
        [
            'name' => 'Редактор страниц',
            'rights' => [
                'cms',
                'pages',
            ],
        ],
        [
            'name' => 'Редактор',
            'rights' => [
                'cms',
                'posts',
                'rubric.list',
                'rubric.create',
                'post.list',
                'post.create',
                'comment.list',
            ],
        ],
        [
            'name' => 'Модератор',
            'rights' => [
                'cms',
                'posts',
                'comment.list',
                'comment.publish',
                'rubric.list',
                'post.list',
                'post.publish',
            ],
        ],
        [
            'name' => 'Администратор',
            'rights' => [
                'cms',
                'pages',
                'posts',
                'comment.list',
                'rubric.list',
                'post.list',
                'users',
                'user.list',
                'user.create',
                'group.list',
                'group.create',
                'right.list',
                'settings',
            ],
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     * @throws Throwable
     */
    public function up(): void
    {
        $userRights = Right::all()->pluck('id', 'right')->toArray();

        foreach (static::USER_GROUPS as $userGroup) {
            $group = new Group(['name' => $userGroup['name']]);
            $group->saveOrFail();
            $rights = [];
            foreach ($userGroup['rights'] as $right) {
                $rights[] = $userRights[$right];
            }
            $group->rights()->attach($rights);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Group::query()->truncate();
    }
}
