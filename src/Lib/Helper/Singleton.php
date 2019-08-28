<?php

namespace Helper;

trait Singleton
{
    protected static $Instances = array();
    protected function __construct() {}
    /**
     * @return static
     */
    public static function getInstance()
    {
        $class = static::class;
        if (!isset(self::$Instances[$class])) {
            self::$Instances[$class] = new static();
        }
        return self::$Instances[$class];
    }
    final private function __clone() {}
    final private function __wakeup() {}
}

