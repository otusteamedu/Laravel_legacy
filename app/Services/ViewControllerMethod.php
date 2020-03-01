<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

class ViewControllerMethod
{

    public static function getMethod()
    {
        $controller = explode('@', Route::currentRouteAction());
        return $controller[1];
    }
    
}