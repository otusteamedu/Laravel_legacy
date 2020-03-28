<?php


namespace App\Services\Tariffs\Handlers;


use App\Models\Tariff;
use App\Services\Tariffs\Repositories\EloquentTariffRepository;

class CreateTariffHandler
{

    private $tariffRepository;

    public function __construct(
        EloquentTariffRepository $tariffRepository
    )
    {
        $this->tariffRepository = $tariffRepository;
    }

    /**
     * @param array $data
     * @return Tariff
     */
    public function handle(array $data): Tariff
    {
        return $this->tariffRepository->createFromArray($data);
    }

}
