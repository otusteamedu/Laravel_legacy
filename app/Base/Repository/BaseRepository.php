<?php


namespace App\Base\Repository;

// use http\Exception\InvalidArgumentException;
use App\Base\Factory;
use App\Base\Service\Q;
use App\Base\WrongNamespaceException;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * Размещаем здесь общие методы, которые присутствуют в всех
 * репозиториях. На данном этапе мы не отрываемся от Eloquent, просто обобщаем работу с репозиториями
 * для конкретного проекта. По-хорошему, репозиторий не должен быть завязан на конкретный слой данных, но
 * это большая работа
 *
 * @package App\Base\Repository
 */
class BaseRepository implements IBaseRepository
{
    /**
     * BaseRepository constructor
     */
    public function __construct()
    {
    }
    /**
     * Получить модель по первичному ключу
     *
     * @param int $primary
     * @return Model|null
     * @throws WrongNamespaceException
     */
    public function getByPrimary(int $primary): ?Model {
        // пока не изучил Builder считаю $primary интежер
        $model = $this->getModel();
        return $model->find($primary);
    }

    /**
     * Получить объект запроса на основе массива ограничений
     *
     * @param array $filter
     * @return Builder
     * @throws WrongNamespaceException
     */
    private function filterQuery(array $filter = [], array $order = []) : Builder {
        $builder = $this->getModel()->newQuery();
        return $this->getFilter($builder)->apply($filter, $order);
    }
    /**
     * @param array $filter
     * @param array $order
     * @param array|null $nav
     * @return Collection
     * @throws WrongNamespaceException
     */
    public function getList(array $filter = [], array $order = [], array &$nav = null): Collection {
        $builder = $this->filterQuery($filter, $order);

        if($nav !== null) {
            $perPage = isset($nav['per_page']) && is_scalar($nav['per_page']) ? intval($nav['per_page']) : null;
            if(empty($perPage)) $perPage = null;

            $paginator = $builder->paginate($perPage);
            $nav = $paginator->toArray();
            $nav['html'] = $paginator->links()->toHtml();

            return $paginator->getCollection();
        }

        return $builder->get();
    }

    public function getQList(Q $query): Collection {

    }

    public function getItems(array $filter = [], array $order = [], array &$nav = null): array {
        return $this->getList($filter, $order, $nav)->all();
    }

    /**
     * @param array $data
     * @return Model
     * @throws WrongNamespaceException
     */
    public function createFromArray(array $data): Model
    {
        $model = $this->getModel();
        $model->fill($data);
        $model->save();

        return $model;
    }
    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function updateFromArray(Model $model, array $data): Model
    {
        $model->update($data);
        return $model;
    }
    /**
     * @param Model $model
     * @throws Exception
     */
    public function remove(Model $model) {
        $model->delete();
    }
    /**
     * @return Model
     * @throws WrongNamespaceException
     */
    protected function getModel() {
        return Factory::getInstance()->getModelFor($this);
    }
    /**
     * @param Builder $builder
     * @return BaseFilter
     * @throws WrongNamespaceException
     */
    protected function getFilter(Builder $builder): BaseFilter {
        return Factory::getInstance()->getFilterFor($this, $builder);
    }
}
