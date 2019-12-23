<?php
/**
 * Description of CreateCountryHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\SMS\SMSService;
use Carbon\Carbon;

class CreateCountryHandler
{

    private $countryRepository;

    private $sendSMSCreatedCountryHandler;

    public function __construct(
        CountryRepositoryInterface $countryRepository,
        SendSMSCreatedCountryHandler $sendSMSCreatedCountryHandler
    )
    {
        $this->countryRepository = $countryRepository;
        $this->sendSMSCreatedCountryHandler = $sendSMSCreatedCountryHandler;
    }

    /**
     * @param array $data
     * @return Country
     */
    public function handle(array $data): Country
    {
        $data['created_at'] = Carbon::create()->subDay();
        $data['name'] = ucfirst($data['name']);

        $country = $this->countryRepository->createFromArray($data);

        $this->sendSMSCreatedCountryHandler->handle($country);
        return $country;
    }

}