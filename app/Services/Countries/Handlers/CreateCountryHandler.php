<?php
/**
 * Хэндлер для добавления стран
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

    /**
     * @param array $data
     * @return Country
     */
    public function handle(array $data): Country
    {
        $data['name'] = trim(ucfirst($data['name'] ?? ''));
        $data['name_eng'] = trim(ucfirst($data['name_eng'] ?? ''));
        return $this->countryRepository->createFromArray($data);
    }

}
