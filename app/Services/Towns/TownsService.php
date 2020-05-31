<?php


namespace App\Services\Towns;


use App\Models\Town;
use App\Services\Towns\Repositories\TownRepositoryInterface;

class TownsService
{
    private $townRepository;

    public function __construct(TownRepositoryInterface $townRepository)
    {
        $this->townRepository = $townRepository;
    }

    public function showTownList()
    {
        return $this->townRepository->list();
    }

    public function storeTown($data)
    {
        return $this->townRepository->createFromArray($data);
    }

    public function updateTown(Town $town, array $data)
    {
        return $this->townRepository->updateFromArray($town, $data);
    }

    public function deleteTown(Town $town)
    {
        return $this->townRepository->destroyFromObj($town);
    }
}
