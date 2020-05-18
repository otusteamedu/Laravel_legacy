<?php


namespace App\Services\Constructions;

use App\Models\Construction;
use App\Services\Constructions\Handlers\CreateConstructionHandler;
use App\Services\Constructions\Handlers\DeleteConstructionHandler;
use App\Services\Constructions\Repositories\ConstructionRepositoryInterface;

class ConstructionsService
{

    private $createConstructionHandler;
    private $deleteConstructionHandler;
    private $constructionRepository;

    public function __construct(
        CreateConstructionHandler $createConstructionHandler,
        DeleteConstructionHandler $deleteConstructionHandler,
        ConstructionRepositoryInterface $constructionRepository
    )
    {
        $this->createConstructionHandler = $createConstructionHandler;
        $this->deleteConstructionHandler = $deleteConstructionHandler;
        $this->constructionRepository = $constructionRepository;
    }

    /**
     * @param array $data
     * @return Construction
     */
    public function createConstruction(array $data): Construction
    {
        return $this->createConstructionHandler->handle($data);
    }


    public function getAllConstruction()
    {
        return $this->constructionRepository->getAllConstruction();
    }

    public function findOrNew($id = null): Construction
    {
        /** @var Construction $langConstructor */
        if ($id && !is_null($langConstructor = $this->constructionRepository->find($id))) {
            return $langConstructor;
        }

        return $this->constructionRepository->new();
    }

    public function delete($id): Int
    {
        return $this->deleteConstructionHandler->handle($id);

    }

}
