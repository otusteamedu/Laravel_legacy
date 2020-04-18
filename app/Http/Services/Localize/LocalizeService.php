<?php

namespace App\Http\Services\Localize;

class LocalizeService 
{
    public function localizePrefix(){
        $local = request()->segment(1, '/');
        $localizeSiteArray = config('app.localizes');
        if(!empty($local) && in_array($local, $localizeSiteArray)){
            return $local;
        }
        return '';
    }
}
