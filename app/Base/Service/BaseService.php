<?php


namespace App\Base\Service;

use App\Base\Factory;
use App\Base\Repository\BaseFilter;
use App\Base\Repository\BaseRepository;
use App\Base\WrongNamespaceException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseService implements IBaseService
{
    private $baseRepository;

    /**
     * Сервис c зависимостями создается контейнером, но для базовых
     * функций необходим репозиторий, связанный с базовой моделью
     *
     * BaseService constructor.
     */
    public function __construct() {
        $this->baseRepository = null;
    }
    /**
     * @param int $primary
     * @return Model
     * @throws WrongNamespaceException
     */
    public function findModel(int $primary): Model {
        $modelName = $this->getModel();
        return $modelName::findOrFail($primary);
    }
    /**
     * @param int $primary
     * @return Model|null
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function findByID(int $primary): ?Model {
        return $this->getRepository()->getByPrimary($primary);
    }
    /**
     * @param array $filter
     * @param array $order
     * @param array|null $nav
     * @return Collection
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function paginateByFilter(array $filter = [], array $order = [], array &$nav = null): Collection {
        return $this->getRepository()->getList($filter, $order, $nav);
    }
    /**
     * @param array $filter
     * @param array $order
     * @return Collection
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function findByFilter(array $filter = [], array $order = []): Collection {
        return $this->getRepository()->getList();
    }
    /**
     * @param array $filter
     * @param array $order
     * @param array|null $nav
     * @return Model|null
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function findOneByFilter(array $filter = [], array $order = []): ?Model {
        $result = $this->findByFilter($filter, $order);
        return $result->isEmpty() ? null : $result->first();
    }
    /**
     * @param array $data
     * @return Model
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function store(array $data): Model {
        return $this->getRepository()->createFromArray($data);
    }
    /**
     * @param int $primary
     * @param array $data
     * @return Model
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function update(int $primary, array $data): Model {
        $model = $this->findModel($primary);
        return $this->getRepository()->updateFromArray($model, $data);
    }
    /**
     * @param int $primary
     * @throws WrongNamespaceException
     * @throws BindingResolutionException
     * @throws \Exception
     */
    public function remove(int $primary) {
        $model = $this->findModel($primary);
        $this->getRepository()->remove($model);
    }
    /**
     * @return Model
     * @throws WrongNamespaceException
     */
    protected function getModel() {
        return Factory::getInstance()->getModelFor($this);
    }
    /**
     * @return BaseRepository
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function getRepository(): BaseRepository {
        if(is_null($this->baseRepository))
            $this->baseRepository = Factory::getInstance()->getRepositoryFor($this);

        return $this->baseRepository;
    }
}
