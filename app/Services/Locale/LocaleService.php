<?php


namespace App\Services\Locale;


use App\Services\Locale\Handlers\RequestLocaleHandler;
use Illuminate\Http\Request;

class LocaleService
{

    /**
     * @var RequestLocaleHandler
     */
    private RequestLocaleHandler $requestLocaleHandler;

    public function __construct(RequestLocaleHandler $requestLocaleHandler)
    {

        $this->requestLocaleHandler = $requestLocaleHandler;
    }


    public function lacalizeRequest(Request $request)
    {
        $this->requestLocaleHandler->handler($request);
    }

}
