<?php


namespace App\Base\Service;

use App\Base\Factory;
use App\Base\Repository\BaseRepository;
use App\Base\WrongNamespaceException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BaseService implements IBaseService
{
    const DEFAULT_CACHE_TTL = 900;

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
    /**
     * Если запрашиваемый метод оканчивается на Cached, возвратив некешируемую
     * версию метода
     *
     * @param $name
     * @return string|null
     */
    private function notCachedMethod($name): ?string {
        $endsOn = "Cached";
        $len = strlen($endsOn);
        if(substr($name, -$len, $len) == $endsOn)
            return substr($name, 0, strlen($name)-$len);
        return null;
    }

    /**
     * Ищем метод в себе или репозитории по-умолчанию, выбрасываем исключение
     *
     * @param $name
     * @return array
     */
    private function getTargetMethod($name): array {
        if(method_exists($this, $name))
            return [$this, $name];

        try {
            $repository = $this->getRepository();
            if(method_exists($repository, $name))
                return [$repository, $name];
        }
        catch (\Exception $e) {
        }

        throw new \InvalidArgumentException("Method [{$name}] is not supported.");
    }
    /**
     * Пытаемся вызвать некеширущую версию метода, если он оканчивается на
     * Cached, иначе пытаемся найти метод с таким же названием в репозитории по-умолчанию.
     * Если вызывается кешированная версия метода, но без параметров кеширования последним аргуметом,
     * делаем его по-умолчанию
     *
     * Результат возвращаем в виде ассоциативного массива
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments ) {
        $bCacheResult = false;
        $cacheParams = null;
        $cachedFn = $this->notCachedMethod($name);

        if($cachedFn) {
            $name = $cachedFn;
            $bCacheResult = true;
            if($arguments[count($arguments)-1] instanceof CD)
                $cacheParams = array_pop($arguments);
            else {
                $cacheParams = new CD(array_merge([$name], $arguments), self::DEFAULT_CACHE_TTL);
            }
        }

        $callMethod = $this->getTargetMethod($name);
        if($bCacheResult) {
            $tags = $cacheParams->getTags();
            //if(!empty($tags))
            //   $manager->tags();
            return app('cache')->remember(
                $cacheParams->getKey(),
                $cacheParams->getTTL(),
                function () use ($callMethod, $arguments) {
                    return call_user_func_array($callMethod, $arguments);
                }
            );
        }

        return call_user_func_array($callMethod, $arguments);
    }
}
