<?php


namespace App\Services\Constructions\Handlers;


use App\Services\Constructions\Repositories\ConstructionRepositoryInterface;


class DeleteConstructionHandler
{
    private $constructionRepository;

    public function __construct(
        ConstructionRepositoryInterface $constructionRepository
    )
    {
        $this->constructionRepository = $constructionRepository;
    }

    /**
     * @param int $id
     * @return int
     */

    public function handle(int $id): int
    {
        return $this->constructionRepository->delete($id);
    }
}
