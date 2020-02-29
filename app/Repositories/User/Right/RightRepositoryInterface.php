<?php

namespace App\Repositories\User\Right;

use App\Models\User\Right;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface RightRepositoryInterface
 * @package App\Repositories\User\Right
 */
interface RightRepositoryInterface
{
    /** @var string CMS - Административный интерфейс */
    public const CMS = 'cms';

    /** @var string PAGES - Модуль "Страницы" */
    public const PAGES =  'pages';

    /** @var string POSTS - Модуль "Новости" */
    public const POSTS = 'posts';

    /** @var string COMMENT_LIST - Просмотр комментариев */
    public const COMMENT_LIST = 'comment.list';

    /** @var string COMMENT_PUBLISH - Публикация комментарив */
    public const COMMENT_PUBLISH = 'comment.publish';

    /** @var string COMMENT_PUBLISH - Просмотр рубрик' */
    public const RUBRIC_LIST = 'rubric.list';

    /** @var string COMMENT_PUBLISH - Создание рубрик */
    public const RUBRIC_CREATE = 'rubric.create';

    /** @var string COMMENT_PUBLISH - Просмотр новостей */
    public const POST_LIST = 'post.list';

    /** @var string COMMENT_PUBLISH - Создание новостей */
    public const POST_CREATE = 'post.create';

    /** @var string COMMENT_PUBLISH - Публикация новостей */
    public const POST_PUBLISH = 'post.publish';

    /** @var string COMMENT_PUBLISH - Модуль "Пользователи" */
    public const USERS = 'users';

    /** @var string COMMENT_PUBLISH - Просмотр пользователей */
    public const USER_LIST = 'user.list';

    /** @var string COMMENT_PUBLISH - Добавление пользователей */
    public const USER_CREATE = 'user.create';

    /** @var string COMMENT_PUBLISH - Просмотр групп */
    public const GROUP_LIST = 'group.list';

    /** @var string COMMENT_PUBLISH - Добавление групп */
    public const GROUP_CREATE = 'group.create';

    /** @var string COMMENT_PUBLISH - Просмотр прав */
    public const RIGHT_LIST = 'right.list';

    /** @var string COMMENT_PUBLISH - Модуль "Настройки" */
    public const SETTINGS = 'settings';

    /**
     * Получаем все права
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Возвращаем список прав с пагенацией
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginationList(array $options): LengthAwarePaginator;

    /**
     * Возвращает массив прав
     * @param array $options
     * @return array
     */
    public function arrayList(array $options): array;
}