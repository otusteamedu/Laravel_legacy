<?php

namespace App\Common\Handler;
use App\Common\Worker\AbstractWorker;
use App\Common\Config\Config;
use App\Common\Config\Options;
use Doctrine\ORM\EntityManager;

/**
 * абстрактный объект загрузки или выгрузки
 */

abstract class Handler extends AbstractWorker implements IHandler
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(Config $config, EntityManager $em) {
        $this->entityManager = $em;

        $default = $this->getOptions()->getDefault();
        $config = $default->merge($config);

        parent::__construct($config);
    }

    public function getParam($name) : string {
        return $this->getConfig()->get($name);
    }

    public function getEntityManager(): EntityManager {
        return $this->entityManager;
    }

    // эти функции определяются в конечных разделах
    abstract public function getType() : string;
    abstract public function getId() : string;
    abstract public function getOptions() : Options;
}