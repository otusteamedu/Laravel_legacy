<?php
/**
 * Хэндлер для изменения стран
 */

namespace App\Services\Countries\Handlers;


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
     * @return bool
     */
    public function handle(int $id, array $data): int
    {
        $data['name'] = ucfirst($data['name'] ?? '');
        $data['name_eng'] = ucfirst($data['name_eng'] ?? '');
        return $this->countryRepository->updateFromArray($id, $data);
    }

}
