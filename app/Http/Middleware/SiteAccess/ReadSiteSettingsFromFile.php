<?php


namespace App\Http\Middleware\SiteAccess;

/**
 * Class ReadSiteSettingsFromFile Считывает настройки сайта из файла siteSettngs.json
 * @package App\Http\Middleware\SiteAccess
 */

class ReadSiteSettingsFromFile
{
    public static function getSiteSettings()
    {
        //$fileName="site-settings.json";// файл, с настройками видимости
        $fileName=ENV("SITE_SETTINGS_FILE_NAME");//имя файлф, с настройками видимости
        $fileUrl=dirname(__FILE__)."/".$fileName;
        $str = file_get_contents($fileUrl);//считай файл и всё его содержимое передай в строку
        $obj = json_decode($str);

        //Считает значения в виде строковых true или false.
        //Внимание! Для PHP это всё ещё не булевые, а просто строковые значения.
        $siteIsOn = $obj->{'siteIsOn'};
        $filterIp = $obj->{'filterIp'};
        $mobileOnly = $obj->{'mobileOnly'};

        //преобразуем строковые true / false => булевые true(1) / false()
        $siteIsOn = self::formatToBool($siteIsOn);
        $filterIp = self::formatToBool($filterIp);
        $mobileOnly = self::formatToBool($mobileOnly);

        // "запакуем" в ассоциативный массив
        $site_settings = [
            'siteIsOn' => $siteIsOn,
            'filterIp' => $filterIp,
            'mobileOnly' => $mobileOnly
        ];
        return $site_settings;
    }
    /**
     * Конвертирует строковые значения "true", "false" в булевые значения true, false PHP
     * @param $s string входное значение
     * @return bool
     */
    private static function formatToBool($s)
    {
        $result=false;

        if(strtoupper($s)=="TRUE")
        {
            $result = true;
        }
        if(strtoupper($s)=="FALSE")
        {
            $result = false;
        }
        return $result;
    }
}
