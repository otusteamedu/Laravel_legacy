<?php

namespace App\Http\Services\Localize;

use Illuminate\Support\Facades\Facade;

class LocalizeFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'Localize';
    }
}
