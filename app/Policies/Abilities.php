<?php

namespace App\Policies;

/**
 * Настройки прав
 * Class Abilities
 * @package App\Policies
 */
final class Abilities
{
    /** @var string CMS - Административный интерфейс */
    public const CMS = 'cms';

    /** @var string VIEW_ANY - просмотр списка */
    public const VIEW_ANY = 'viewAny';

    /** @var string VIEW - просмотр сущности */
    public const VIEW = 'view';

    /** @var string CREATE - создание сущности */
    public const CREATE = 'create';

    /** @var string UPDATE - обновление сущности */
    public const UPDATE = 'update';

    /** @var string PUBLISHED - публикация сущности */
    public const PUBLISHED = 'published';

    /** @var string DELETE - удаление сущности */
    public const DELETE = 'delete';

    /** @var string RESTORE - востановление сущности */
    public const RESTORE = 'restore';

    /** @var string FORCE_DELETE - форсированное удаление */
    public const FORCE_DELETE = 'forceDelete';
}