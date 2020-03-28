<?php


namespace App\Services\Tariffs;

use App\Models\Tariff;
use App\Services\Tariffs\Handlers\CreateTariffHandler;
use App\Services\Tariffs\Repositories\TariffRepositoryInterface;


class TariffsService
{
    private $tariffRepository;
    private $createTariffHandler;

    public function __construct(
        CreateTariffHandler $createTariffHandler,
        TariffRepositoryInterface $tariffRepository
    )
    {
        $this->createTariffHandler = $createTariffHandler;
        $this->tariffRepository = $tariffRepository;
    }

    /**
     * @param array $data
     * @return Tariff
     */
    public function storeTariff(array $data): Tariff
    {
        return $this->createTariffHandler->handle($data);
    }

}
