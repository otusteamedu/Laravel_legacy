<?php

namespace Core;

abstract class Controller
{
    /**
     * @param $method
     * @param $args
     * @throws \Exception
     */
    public function __call($method, $args)
    {
        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], $args);
        } else {
            throw new \Exception("Method '$method' not found in controller " . get_class($this));
        }
    }
}
