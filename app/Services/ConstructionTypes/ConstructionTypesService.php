<?php


namespace App\Services\ConstructionTypes;

use App\Models\ConstructionType;
use App\Services\ConstructionTypes\Handlers\CreateConstructionTypeHandler;
use App\Services\ConstructionTypes\Handlers\DeleteConstructionTypeHandler;
use App\Services\ConstructionTypes\Repositories\ConstructionTypesRepositoryInterface;
use Illuminate\Support\Collection;

class ConstructionTypesService
{

    private $createConstructionTypeHandler;
    private $deleteConstructionTypeHandler;
    private $constructionTypeRepository;

    public function __construct(
        CreateConstructionTypeHandler $createConstructionTypeHandler,
        DeleteConstructionTypeHandler $deleteConstructionTypeHandler,
        ConstructionTypesRepositoryInterface $constructionTypeRepository
    )
    {
        $this->createConstructionTypeHandler = $createConstructionTypeHandler;
        $this->deleteConstructionTypeHandler = $deleteConstructionTypeHandler;
        $this->constructionTypeRepository = $constructionTypeRepository;
    }

    /**
     * @param array $data
     * @return ConstructionType
     */
    public function createConstructionType(array $data): ConstructionType
    {
        return $this->createConstructionTypeHandler->handle($data);
    }


    public function getAllConstructionTypes()
    {
        return $this->constructionTypeRepository->getAllConstructionTypes();
    }

    public function getListTypes()
    {
        /** @var ConstructionType  $constructorTypes */
        $constructorTypes = $this->constructionTypeRepository->getAllConstructionTypes();

        if($constructorTypes ){
            return $constructorTypes->mapWithKeys(function ($item){
                return [$item->code => $item->name];
            });
        }

        return new Collection();

    }

    public function findOrNew($id = null): ConstructionType
    {
        /** @var ConstructionType $langConstructor */
        if ($id && !is_null($langConstructor = $this->constructionTypeRepository->find($id))) {
            return $langConstructor;
        }

        return $this->constructionTypeRepository->new();
    }

    public function delete($id): Int
    {
        return $this->deleteConstructionTypeHandler->handle($id);

    }

}
