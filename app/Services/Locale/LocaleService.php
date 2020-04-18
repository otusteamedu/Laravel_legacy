<?php
/**
 * Description of LocaleService.php
 */

namespace App\Services\Locale;


use App\Services\Locale\Handlers\RequestLocaleHandler;
use Illuminate\Http\Request;

class LocaleService
{

    private $requestLocaleHandler;

    public function __construct(
        RequestLocaleHandler $requestLocaleHandler
    )
    {
        $this->requestLocaleHandler = $requestLocaleHandler;
    }

    public function localizeRequest(Request $request)
    {
        $this->requestLocaleHandler->handle($request);
    }

}
