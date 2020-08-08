<?php

namespace App\Services\Localize\Handlers;

use App\Services\Locale\Locale;
use App\Services\Localize\Repositories\LocalizeRepositoryInterface;

/**
 * Установка локализации
 * Class BusinessCreateHandler
 * @package App\Services\Businesses\Handlers
 */
class LocalizeHandler
{

    /**
     * @var LocalizeRepositoryInterface
     */
    private $repository;

    public function __construct(
        LocalizeRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param string $locale
     * @return bool
     */
    public function handle(string $locale): bool
    {
        if (!Locale::isSupported($locale))
            return false;

        return $this->repository->set($locale);
    }
}
