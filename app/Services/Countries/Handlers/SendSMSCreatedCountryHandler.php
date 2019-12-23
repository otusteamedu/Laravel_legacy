<?php
/**
 * Description of SendSMSCreatedCountryHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\SMS\SMSService;

class SendSMSCreatedCountryHandler
{
    private $SMSService;

    public function __construct(
        SMSService $SMSService
    )
    {
        $this->SMSService = $SMSService;
    }

    /**
     * @param Country $country
     */
    public function handle(Country $country)
    {
        $this->SMSService->send(
            $this->getSendToPhone(),
            $this->generateSMSMessage($country)
        );
    }

    /**
     * @return string
     */
    private function getSendToPhone(): string
    {
        return config('app.service_phone');
    }

    /**
     * @param Country $country
     * @return string
     */
    private function generateSMSMessage(Country $country): string
    {
        return trans('sms.country_created', [
            'name' => $country->name,
        ]);
    }
}