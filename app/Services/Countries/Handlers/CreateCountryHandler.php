<?php
/**
 * Description of CreateCountryHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Carbon\Carbon;

class CreateCountryHandler
{

    private $countryRepository;

    public function __construct(
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->countryRepository = $countryRepository;
    }


    public function handle(array $data): Country
    {
        $data['created_at'] = Carbon::create()->subDay();
        $data['name'] = ucfirst($data['name']);

        return $this->countryRepository->createFromArray($data);
    }

}