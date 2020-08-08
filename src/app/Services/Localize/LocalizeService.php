<?php

namespace App\Services\Localize;

use App\Services\Localize\Handlers\LocalizeHandler;
use App\Services\Localize\Repositories\LocalizeRepositoryInterface;

class LocalizeService
{

    /**
     * @var LocalizeHandler
     */
    private $setHandler;
    /**
     * @var LocalizeRepositoryInterface
     */
    private $repository;

    public function __construct(
        LocalizeHandler $setHandler,
        LocalizeRepositoryInterface $repository
    )
    {
        $this->setHandler = $setHandler;
        $this->repository = $repository;
    }

    /**
     * Установить локализацию
     * @param string $locale
     * @return bool
     */
    public function set(string $locale): bool
    {
        return $this->setHandler->handle($locale);
    }

    /**
     * Вернуть локаль
     * @return string
     */
    public function get(): string
    {
        return $this->repository->get();
    }
}
