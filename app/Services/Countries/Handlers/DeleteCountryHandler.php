<?php
/**
 * Хэндлер для удаления стран
 */

namespace App\Services\Countries\Handlers;


use App\Services\Countries\Repositories\CountryRepositoryInterface;
use Carbon\Carbon;

class DeleteCountryHandler
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
     * @return bool
     */
    public function handle(int $id): bool
    {
        return $this->countryRepository->delete($id);
    }

}
