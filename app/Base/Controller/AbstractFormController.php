<?php


namespace App\Base\Controller;


use App\Base\Factory;
use Illuminate\Http\Request;

/**
 * Форма, связанная с редактированием модели
 *
 * Class AbstractFormController
 * @package App\Base\Controller
 */
abstract class AbstractFormController extends AbstractController
{
    use TUploadable;
    /**
     * шаблонный метод
     * Before:
     * Проверка прав. Права проверяем на модель на основе политик
     * Валидация ввода. В случае успеха идем далее. Иначе
     * генерация события Before, которое можно отменить
     * --
     * выполнение действия
     * --
     * After:
     * генерация события After
     *
     * @param mixed $model
     * @param string $action
     * @param Request $request
     * @param mixed ...$parameters
     *
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function templateAction($model, string $action, Request $request,...$parameters)
    {
        $this->authorize($action, $model);

        $factory = new Factory();
        //$policy = $factory->getPolicy($modelName);
    }
}
