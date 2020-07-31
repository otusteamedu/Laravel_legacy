<?php
/**
 * Description of CreateCountryHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use App\Services\Notifications\SMS\SmsSender;

class CreateCountryHandler
{

    private CountryRepositoryInterface $countryRepository;
    private SmsSender $sender;

    public function __construct(
        CountryRepositoryInterface $countryRepository,
        SmsSender $sender
    )
    {
        $this->countryRepository = $countryRepository;
        $this->sender = $sender;
    }


    public function handle(array $data): Country
    {
        $country = $this->countryRepository->createFromArray($data);

        $this->sender->send('78099999999', 'New country Created');
        return $country;
    }

}
