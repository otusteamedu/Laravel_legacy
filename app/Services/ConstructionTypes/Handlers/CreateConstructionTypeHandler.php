<?php


namespace App\Services\ConstructionTypes\Handlers;

use App\Models\ConstructionType;
use App\Services\ConstructionTypes\Repositories\ConstructionTypesRepositoryInterface;

class CreateConstructionTypeHandler
{
    private $constructionTypesRepository;

    public function __construct(
        ConstructionTypesRepositoryInterface $constructionTypesRepository
    )
    {
        $this->constructionTypesRepository = $constructionTypesRepository;
    }

    /**
     * @param array $data
     * @return ConstructionType
     */

    public function handle(array $data): ConstructionType
    {
        return $this->constructionTypesRepository->createFromArray($data);
    }
}
