<?php

namespace App\Services\Localize;

use App\Services\Localize\Handlers\LocalizeSetHandler;

class LocalizeService
{

    /**
     * @var LocalizeSetHandler
     */
    private $setHandler;

    public function __construct(
        LocalizeSetHandler $setHandler
    )
    {
        $this->setHandler = $setHandler;
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
}
