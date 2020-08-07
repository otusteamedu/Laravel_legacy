<?php

namespace App\Services\Localize\Repositories;

interface LocalizeRepositoryInterface
{
    /**
     * Сохранить локаль
     * @return mixed
     */
    public function set(string $locale): bool;

    /**
     * Получить локаль
     * @return mixed
     */
    public function get(): string;
}
