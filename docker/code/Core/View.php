<?php

namespace Core;

class View
{
    /**
     * @param $view
     * @param array $data
     * @throws \Exception
     */
    public static function render($view, $data = []): void
    {
        $file = "../App/Views/$view";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("View '$file' not found");
        }
    }
}
