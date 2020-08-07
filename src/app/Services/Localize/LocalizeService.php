<?php

namespace App\Services\Localize;

use App\Services\Localize\Handlers\LocalizeSetHandler;
use App\Services\Localize\Repositories\LocalizeRepositoryInterface;

class LocalizeService
{

    /**
     * @var LocalizeSetHandler
     */
    private $setHandler;
    /**
     * @var LocalizeRepositoryInterface
     */
    private $repository;

    public function __construct(
        LocalizeSetHandler $setHandler,
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
