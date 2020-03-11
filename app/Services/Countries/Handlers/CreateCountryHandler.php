<?php
/**
 * Хэндлер для добавления стран
 */

namespace App\Services\Countries\Handlers;


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
     * @return int
     */
    public function handle(array $data): int
    {
        $data['name'] = ucfirst($data['name'] ?? '');
        $data['name_eng'] = ucfirst($data['name_eng'] ?? '');
        return $this->countryRepository->createFromArray($data);
    }

}
