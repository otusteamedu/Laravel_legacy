<?php


namespace App\Services\Locale\Handlers;


use Illuminate\Http\Request;

class RequestLocaleHandler
{

    public function handler(Request $request)
    {
        $locale = $request->route('locale');
        if($locale){
            \App::setLocale($locale);
        }
        $request->route()->forgetParameter('locale');
    }

    /*public function forSomeLogic()
    {

    }*/

}
