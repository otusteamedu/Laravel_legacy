<?php

namespace App\Common\Handler;
use App\Common\Worker\AbstractWorker;
use App\Common\Config\Config;
use App\Common\Config\Options;

/**
 * абстрактный объект загрузки или выгрузки
 */

abstract class Handler extends AbstractWorker implements IHandler
{
    public function __construct(Config $config) {
        $default = $this->getOptions()->getDefault();
        $config = $default->merge($config);

        parent::__construct($config);
    }

    public function getParam($name) : string {
        return $this->getConfig()->get($name);
    }

    // эти функции определяются в конечных разделах
    abstract public function getType() : string;
    abstract public function getId() : string;
    abstract public function getOptions() : Options;
}