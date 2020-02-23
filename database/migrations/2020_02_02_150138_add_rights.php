<?php

use App\Models\User\Right;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddRights
 */
class AddRights extends Migration
{
    /** @var array  */
    protected const RIGHTS = [
            [
                'name' => 'Административный интерфейс',
                'right' => 'cms',
            ],
            [
                'name' => 'Модуль "Страницы"',
                'right' => 'pages',
            ],
            [
                'name' => 'Модуль "Новости"',
                'right' => 'posts',
            ],
            [
                'name' => 'Просмотр комментариев',
                'right' => 'comment.list',
            ],
            [
                'name' => 'Публикация комментарив',
                'right' => 'comment.publish',
            ],
            [
                'name' => 'Просмотр рубрик',
                'right' => 'rubric.list',
            ],
            [
                'name' => 'Создание рубрик',
                'right' => 'rubric.create',
            ],
            [
                'name' => 'Просмотр новостей',
                'right' => 'post.list',
            ],
            [
                'name' => 'Создание новостей',
                'right' => 'post.create',
            ],
            [
                'name' => 'Публикация новостей',
                'right' => 'post.publish',
            ],
            [
                'name' => 'Модуль "Пользователи"',
                'right' => 'users',
            ],
            [
                'name' => 'Просмотр пользователей',
                'right' => 'user.list',
            ],
            [
                'name' => 'Добавление пользователей',
                'right' => 'user.create',
            ],
            [
                'name' => 'Просмотр групп',
                'right' => 'group.list',
            ],
            [
                'name' => 'Добавление групп',
                'right' => 'group.create',
            ],
            [
                'name' => 'Просмотр прав',
                'right' => 'right.list',
            ],
            [
                'name' => 'Модуль "Настройки"',
                'right' => 'settings',
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
        foreach (self::RIGHTS as $right) {
            $rightModel = new Right($right);
            $rightModel->saveOrFail();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Right::query()->truncate();
    }
}
