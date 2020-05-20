<?php

namespace Core;

class Router
{
    private $controller;
    private $action;

    public function __construct()
    {
        $path = (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '/') ? ltrim($_SERVER['REQUEST_URI'], '/') : 'home/index';
        $path = explode('/', $path);
        $this->controller = ucfirst($path[0]);

        if (!isset($path[1])) {
            $this->action = 'indexAction';
        } else {
            $this->action = sprintf('%sAction', $path[1]);
        }
    }

    public function getController() : string
    {
        return sprintf('\App\Controllers\%s', $this->controller);
    }

    public function getAction() : string
    {
        return $this->action;
    }
}
