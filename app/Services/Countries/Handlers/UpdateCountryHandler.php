<?php
/**
 * Хэндлер для изменения стран
 */

namespace App\Services\Countries\Handlers;


use App\Models\Country;
use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Carbon\Carbon;

class UpdateCountryHandler
{

    private $countryRepository;

    public function __construct(
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Country
     */
    public function handle(int $id, array $data): Country
    {
        $data['name'] = trim(ucfirst($data['name'] ?? ''));
        $data['name_eng'] = trim(ucfirst($data['name_eng'] ?? ''));
        return $this->countryRepository->updateFromArray($id, $data);
    }

}
