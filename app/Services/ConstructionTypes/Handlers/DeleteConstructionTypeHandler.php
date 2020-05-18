<?php


namespace App\Services\ConstructionTypes\Handlers;


use App\Services\ConstructionTypes\Repositories\ConstructionTypesRepositoryInterface;


class DeleteConstructionTypeHandler
{
    private $constructionTypesRepository;

    public function __construct(
        ConstructionTypesRepositoryInterface $constructionTypesRepository
    )
    {
        $this->constructionTypesRepository = $constructionTypesRepository;
    }

    /**
     * @param int $id
     * @return int
     */

    public function handle(int $id): int
    {
        return $this->constructionTypesRepository->delete($id);
    }
}
