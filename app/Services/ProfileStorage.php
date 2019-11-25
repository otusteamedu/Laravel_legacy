<?php


namespace App\Services;

class ProfileStorage
{
    private $namespace;

    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    public static function getCookieDomain() {
        $value = $_SERVER['HTTP_HOST'];
        if(strpos($value, 'www.') === 0) $value = substr($value, 4);
        $pos = strpos($value, ':');
        if($pos > 0)
            $value = substr($value, 0, $pos);

        return $value;
    }

    public static function getSavedParam($name, $arValues, $default = 0, $offset = 2592000, $path = false)
    {
        global $APPLICATION;
        if(empty($path))
            $path = $APPLICATION->GetCurDir();

        //$value = !isset($_GET[$name]) ? !isset($_COOKIE[$name]) ? '' : $_COOKIE[$name] : intval($_GET[$name]);
        $bSave = isset($_GET[$name]);
        $value = $bSave ? intval($_GET[$name]) : $APPLICATION->get_cookie($name);
        if(!array_key_exists($value, $arValues))
            $value = $default;

        $time = time() + $offset;
        //setcookie($name, $value, $time, $path, self::getCookieDomain());
        if($bSave)
            $APPLICATION->set_cookie($name, $value, $time, $path, self::getCookieDomain(), CMain::IsHTTPS(), false);

        return $value;
    }
}
