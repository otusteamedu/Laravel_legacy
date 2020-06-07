<?php


namespace App\Services;

use \Session;

class LanguageHelper
{
    public function saveLocalToSession($local)
    {
        Session::put('local', $local);
    }
}
