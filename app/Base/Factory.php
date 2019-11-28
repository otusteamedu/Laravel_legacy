<?php


namespace App\Base;

use App\Base\Policy\BasePolicy;
use App\Base\Repository\BaseFilter;
use App\Base\Repository\BaseRepository;
use App\Base\Validator\BaseValidator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Обработку запросов делим на этапы, каждый этап управляется
 * своим классом, так как логика на каждом уровне может быть сложной.
 * Для доступа к связанным с моделью обработчикам используем фабрику.
 *
 * Class Factory
 * @package App\Base
 */
class Factory
{
    /**
     * Соглашение об префиксах связанных объектов
     * Репозитории, Модели, Фильтры, Валидаторы,
     */
    const REPOSITORY_POSTFIX = "Repository";
    const FILTER_POSTFIX = "Filter";
    const VALIDATOR_POSTFIX = "Validator";
    const POLICY_POSTFIX = "Policy";
    const SERVICE_POSTFIX = "Service";

    const REPOSITORY_PREFIX = "App\\Repositories";   // имя репозитория REPOSITORY_PREFIX/<$ModelNamespace>/<$ModelShortName>Repository
    const MODEL_PREFIX = "App\\Models";              // имя модели MODEL_PREFIX/<$ModelNamespace>/<$ModelShortName>
    const FILTER_PREFIX = "App\\Repositories\\Filters";// имя модели FILTER_PREFIX/<$ModelNamespace>/<$ModelShortName>Filter
    const VALIDATOR_PREFIX = "App\\Validators";     // имя модели VALIDATORS_PREFIX/<$ModelNamespace>/<$ModelShortName>Validator
    const POLICY_PREFIX = "App\\Policies";     // имя модели VALIDATORS_PREFIX/<$ModelNamespace>/<$ModelShortName>Policy
    const SERVICE_PREFIX = "App\\Services";     // имя модели VALIDATORS_PREFIX/<$ModelNamespace>/<$ModelShortName>Policy

    /**
     * @var Container
     */
    private $container;

    /**
     * @var Factory
     */
    protected static $_instance;
    /**
     * Factory constructor.
     * @param Container|null $container
     */
    public function __construct(Container $container = null)
    {
        $this->container = $container ?? Container::getInstance();
    }
    /**
     * @return Factory
     */
    public static function getInstance()
    {
        if (is_null(static::$_instance)) {
            static::$_instance = new static;
        }

        return static::$_instance;
    }

    /**
     * @param string $modelName
     * @return Model
     * @throws WrongNamespaceException
     */
    public function getModel(string $modelName): Model {
        $className = $this->getTargetClass($modelName, 'model');
        $instance = new $className;

        if(!($instance instanceof Model)) {
            $message = $className . " is not instance of Illuminate\\Database\\Eloquent\Model";
            throw new WrongNamespaceException($message);
        }

        return $instance;
    }
    /**
     * @param $object
     * @return Model
     * @throws WrongNamespaceException
     */
    public function getModelFor($object) {
        $modelName = static::modelnameByObject($object);
        return $this->getModel($modelName);
    }
    /**
     * @return BaseFilter
     * @throws WrongNamespaceException
     */
    public function getFilter(string $modelName, Builder $builder): BaseFilter {
        $className = $this->getTargetClass($modelName, 'filter');
        if(!class_exists($className)) {
            $className = BaseFilter::class;
        }
        $instance = new $className($builder);

        if(!($instance instanceof BaseFilter)) {
            $message = $className . " is not instance of App\\Base\\BaseFilter";
            throw new WrongNamespaceException($message);
        }

        return $instance;
    }
    /**
     * @param $object
     * @param Builder $builder
     * @return BaseFilter
     * @throws WrongNamespaceException
     */
    public function getFilterFor($object, Builder $builder): BaseFilter {
        $modelName = static::modelnameByObject($object);
        return $this->getFilter($modelName, $builder);
    }
    /**
     * @param string $modelName
     * @return BaseRepository
     * @throws BindingResolutionException
     * @throws WrongNamespaceException
     */
    public function getRepository(string $modelName): BaseRepository {
        return $this->getObject($modelName, 'repository');
    }
    /**
     * @param $object
     * @return BaseRepository
     * @throws WrongNamespaceException
     * @throws BindingResolutionException
     */
    public function getRepositoryFor($object): BaseRepository {
        $modelName = static::modelnameByObject($object);

        return $this->getRepository($modelName);
    }
    /**
     * @return BasePolicy
     * @throws WrongNamespaceException
     * @throws BindingResolutionException
     */
    public function getPolicy(string $modelName): BasePolicy {
        return $this->getTargetObject($modelName, 'policy');
    }
    /**
     * @return BaseValidator
     * @throws WrongNamespaceException
     * @throws BindingResolutionException
     */
    public function getValidator(string $modelName, array $data): BaseValidator {
        return $this->getTargetObject($modelName, 'validator', $data);
    }

    /**
     * @param string $modelName
     * @param string $name
     * @param mixed ...$parameters
     * @return mixed
     * @throws BindingResolutionException
     * @throws \App\Base\WrongNamespaceException
     */
    private function getObject(string $modelName, string $target,...$parameters)
    {
        $target = strtolower($target);
        $upperName = strtoupper(substr($target, 0, 1)).strtolower(substr($target, 1));
        $interfaceName = $this->getTargetClass($modelName, $target, true);
        $baseClass = "App\\Base\\".$upperName."\\Base".$upperName;
        if(!interface_exists($interfaceName)) {
            $instance = new $baseClass();
            return $instance;
        }

        $instance = $this->container->make($interfaceName, $parameters);
        if(!($instance instanceof $baseClass)) {
            $message = $interfaceName . " is not extend of " . $baseClass;
            throw new WrongNamespaceException($message);
        }

        return $instance;
    }

    /**
     * Опорным объектом именования является имя модели
     * @param string $modelName
     * @param string $target
     * @param bool $bInterface
     * @return string
     */
    private function getTargetClass(string $modelName, string $target, bool $bInterface = false): string
    {
        $prefix = "";
        $name = "";
        $pos = strrpos($modelName, "\\");
        if($pos !== false) {
            $prefix = substr($modelName, 0, $pos);
            $name = substr($modelName, $pos + 1);
        }
        else
            $name = $modelName;
        if($bInterface)
            $prefix .= "Interfaces\\I";

        $fqcnClassName = null;
        switch ($target) {
            case 'model':
                $fqcnClassName = self::MODEL_PREFIX . "\\" . $prefix .  $name;
                break;
            case 'repository':
                $fqcnClassName = self::REPOSITORY_PREFIX . "\\" . $prefix .  $name . self::REPOSITORY_POSTFIX;
                break;
            case 'filter':
                $fqcnClassName = self::FILTER_PREFIX . "\\" . $prefix .  $name . self::FILTER_POSTFIX;
                break;
            case 'validator':
                $fqcnClassName = self::VALIDATOR_PREFIX . "\\" . $prefix .  $name . self::VALIDATOR_POSTFIX;
                break;
            case 'policy':
                $fqcnClassName = self::POLICY_PREFIX . "\\" . $prefix .  $name . self::POLICY_POSTFIX;
                break;
            case 'service':
                $fqcnClassName = self::SERVICE_PREFIX . "\\" . $prefix .  $name . self::SERVICE_POSTFIX;
                break;
            //default:
            //    throw new InvalidArgumentException();
        }

        return $fqcnClassName;
    }
    /**
     * Получить имя модели по связанному объекту
     *
     * @param object $object
     * @return string|null
     */
    public static function modelnameByObject(object $object): ?string {
        if(is_object($object))
            return self::modelnameByClass(get_class($object));
        return null;
    }
    /**
     * Получить имя модели по классу связанного объекта
     *
     * @param string $fqcnClassName
     * @return string|null
     */
    public static function modelnameByClass(string $fqcnClassName): ?string {
        $fqcnClassName = str_replace("/", "\\", $fqcnClassName);

        if(
            (strpos($fqcnClassName, self::REPOSITORY_PREFIX) === 0)
            && self::endsWith($fqcnClassName, self::REPOSITORY_POSTFIX)
        ) {
            $len = strlen($fqcnClassName) - strlen(self::REPOSITORY_PREFIX) - strlen(self::REPOSITORY_POSTFIX) - 1;
            return substr($fqcnClassName, strlen(self::REPOSITORY_PREFIX) + 1, $len);
        }

        if(strpos($fqcnClassName, self::MODEL_PREFIX) === 0) {
            return substr($fqcnClassName, strlen(self::MODEL_PREFIX) + 1);
        }

        if(
            (strpos($fqcnClassName, self::FILTER_PREFIX) === 0)
            && self::endsWith($fqcnClassName, self::FILTER_POSTFIX)
        ) {
            $len = strlen($fqcnClassName) - strlen(self::FILTER_PREFIX) - strlen(self::FILTER_POSTFIX) - 1;
            return substr($fqcnClassName, strlen(self::FILTER_PREFIX) + 1, $len);
        }

        if(
            (strpos($fqcnClassName, self::VALIDATOR_PREFIX) === 0)
            && self::endsWith($fqcnClassName, self::VALIDATOR_POSTFIX)
        ) {
            $len = strlen($fqcnClassName) - strlen(self::VALIDATOR_PREFIX) - strlen(self::VALIDATOR_POSTFIX) - 1;
            return substr($fqcnClassName, strlen(self::VALIDATOR_PREFIX) + 1, $len);
        }

        if(
            (strpos($fqcnClassName, self::POLICY_PREFIX) === 0)
            && self::endsWith($fqcnClassName, self::POLICY_POSTFIX)
        ) {
            $len = strlen($fqcnClassName) - strlen(self::POLICY_PREFIX) - strlen(self::POLICY_POSTFIX) - 1;
            return substr($fqcnClassName, strlen(self::POLICY_PREFIX) + 1, $len);
        }

        if(
            (strpos($fqcnClassName, self::SERVICE_PREFIX) === 0)
            && self::endsWith($fqcnClassName, self::SERVICE_POSTFIX)
        ) {
            $len = strlen($fqcnClassName) - strlen(self::SERVICE_PREFIX) - strlen(self::SERVICE_POSTFIX) - 1;
            return substr($fqcnClassName, strlen(self::SERVICE_PREFIX) + 1, $len);
        }

        return null;
    }

    /**
     * Проверка - оканчивается ли строка на указанную строку
     * Утилитная функция, нахождение ее тут протеворечит всем принципам
     * @param string $fqcnClassName
     * @return bool
     */
    private static function endsWith(string $string, string $test): bool {
        return (substr($string, -1 * strlen($test), strlen($test)) == $test);
    }
}
