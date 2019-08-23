<?php

namespace App\DI;

use Symfony\Component\DependencyInjection\ContainerBuilder;

class Injector
{
    const DOCTRINE_ENTITY_TAG = 'doctrine-entity';

    /**
     *@var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    private $container;

    private $configurableClasses = [];
    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
        $this->prepareConfigurableClasses();
    }

    private function prepareConfigurableClasses()
    {
        // Получаем список сервисов с нужным тэгом
        foreach($this->container->findTaggedServiceIds(self::DOCTRINE_ENTITY_TAG) as $id => $tag) {

            // Получаем определение сервиса
            $definition = $this->container->findDefinition($id);

            // Добавляем все нужные setter вызовы
            $this->configurableClasses[$definition->getClass()] = $definition->getMethodCalls();
        }
    }

    public function injectSevicesTo($object)
    {
        if(!is_object($object) || !array_key_exists(get_class($object), $this->configurableClasses)) {
              return;
        }
        
        // Нужно для подстановки параметром в конфигах DIC
        $parameter_bag = $this->container->getParameterBag();

        $calls = $this->configurableClasses[get_class($object)];
        
        foreach($calls as $call) {
            //Собственно вставка зависимостей
            $parametrized_references = $parameter_bag->resolveValue($call[1]);

            call_user_func_array(array($object, $call[0]), $this->container->resolveServices($parametrized_references));
        }
    }
}