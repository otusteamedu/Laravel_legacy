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
     * @param Q $query
     * @return Builder
     * @throws WrongNamespaceException
     */
    private function filterQuery(Q $query = null) : Builder {
        $builder = $this->getModel()->newQuery();
        return $query ? $this->getFilter($builder)->apply($query) : $builder;
    }

    /**
     * @param Q $query
     * @return Collection
     * @throws WrongNamespaceException
     */
    public function getList(Q $query = null): Collection {
        $builder = $this->filterQuery($query);

        if($query && $query->haveNav()) {
            $nav = $query->getNav();
            $perPage = isset($nav['per_page']) && is_scalar($nav['per_page']) ? intval($nav['per_page']) : null;
            if(empty($perPage)) $perPage = null;

            $paginator = $builder->paginate($perPage);
            $nav = $paginator->toArray();
            $nav['html'] = $paginator->links()->toHtml();
            $query->nav($nav);

            return $paginator->getCollection();
        }

        return $builder->get();
    }

    public function getItems(Q $query): array {
        return $this->getList($query)->all();
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
