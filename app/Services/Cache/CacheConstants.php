<?php


namespace App\Services\Cache;


/**
 * Class Constants
 * Константы для работы с кэшем
 * @package App\Services\Cache
 */
class CacheConstants
{
    /**
     *  ttl для сущностей user
     */
    const TIME_FOR_USERS_LIST = 60 * 60;

    /**
     * ttl для подробной информации об одном пользователе
     */
    const TIME_FOR_USER = 30 * 60;
    /**
     *  Тэг для группирования кэша, связанного с сущностями Users
     */
    const USER_ENTITY_TAG = "users";
    /**
     *  Для списка пользователей
     */
    const USERS_LIST_TAG = "users-list";
    /**
     *  Для подробной информации о пользователе
     */
    const USER_TAG = "user";

    /**
     * Строковая часть ключа для кэша конкретного пользователя
     */
    const USER_KEY_FOR_CACHE = 'user_id';
}
