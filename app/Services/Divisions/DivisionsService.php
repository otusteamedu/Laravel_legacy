<?php


namespace App\Services\Divisions;


use App\Models\Division;
use App\Services\Divisions\Repositories\DivisionRepositoryInterface;

class DivisionsService
{

    private $divisionRepository;

    public function __construct(DivisionRepositoryInterface $divisionRepository)
    {
        $this->divisionRepository = $divisionRepository;
    }

    public function getSelectedDivision($division_id)
    {
        return $this->divisionRepository->find($division_id);
    }

    public function showDivisionList()
    {
        return $this->divisionRepository->list();
    }

    public function storeDivision($data)
    {
        return $this->divisionRepository->createFromArray($data);
    }

    public function updateDivision(Division $division, array $data)
    {
        return $this->divisionRepository->updateFromArray($division, $data);
    }

    public function deleteDivision(Division $division)
    {
        return $this->divisionRepository->destroyFromObj($division);
    }



}
