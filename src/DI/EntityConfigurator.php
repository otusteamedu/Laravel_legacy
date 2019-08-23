<?php

namespace App\DI;

use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use DependencyInjection\Injector;

class EntityConfigurator implements EventSubscriber
{
    private $injector;

    public function __construct(Injector $injector)
    {
        $this->injector = $injector;;
    }

    public function getSubscribedEvents()
    {
        return [Events::postLoad];
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->injector->injectSevicesTo($entity);
    }
}