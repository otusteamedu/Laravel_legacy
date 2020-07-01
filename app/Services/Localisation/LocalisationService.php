<?php


namespace App\Services\Localisation;


use App\Services\Localisation\Handlers\RequestLocalisationHandler;
use Illuminate\Http\Request;

class LocalisationService
{

    private $requestLocaleHandler;

    public function __construct(
        RequestLocalisationHandler $requestLocaleHandler
    )
    {
        $this->requestLocaleHandler = $requestLocaleHandler;
    }

    public function LocalisationRequest(Request $request)
    {
        $this->requestLocaleHandler->handle($request);
    }

}
