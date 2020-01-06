<?php

namespace Core;

class Application
{
    /**
     * @throws \Exception
     */
    public function run(): void
    {
        $Router = new Router();
        if (class_exists($Router->getController())) {
            $className = $Router->getController();
            $controller = new $className();
            $actionMethod = $Router->getAction();
            $controller->$actionMethod();
        } else {
            throw new \Exception("Class " . $Router->getController() . " doesn't exists");
        }
    }
}
