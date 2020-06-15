<?php

namespace App\Services\Locale;

use App\Services\Locale\Handlers\RequestLocaleHandler;
use Illuminate\Http\Request;

/**
 * Class LocaleService
 * Сервис работы с локализацией
 *
 * @package App\Services\Locale
 */
class LocaleService
{
    /**
     * @var RequestLocaleHandler
     */
    private $requestLocaleHandler;

    /**
     * LocaleService constructor.
     *
     * @param RequestLocaleHandler $requestLocaleHandler
     */
    public function __construct(RequestLocaleHandler $requestLocaleHandler)
    {
        $this->requestLocaleHandler = $requestLocaleHandler;
    }

    /**
     * Переключение локализации по переданным параметрам в url
     *
     * @param Request $request
     */
    public function localizeRequest(Request $request)
    {
        return $this->requestLocaleHandler->handle($request);
    }
}
