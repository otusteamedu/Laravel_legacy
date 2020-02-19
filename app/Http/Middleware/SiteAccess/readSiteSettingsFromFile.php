<?php

function getSiteSettings()
{
    $fileName="siteSettings.json";// файл, с настройками видимости
    $fileUrl=dirname(__FILE__)."/".$fileName;
    $str = file_get_contents($fileUrl);//считай файл и всё его содержимое передай в строку
    $obj = json_decode($str);

    //Считает значения в виде строковых true или false.
    //Внимание! Для PHP это всё ещё не булевые, а просто строковые значения.
    $siteIsOn = $obj->{'siteIsOn'};
    $filterIp = $obj->{'filterIp'};
    $mobileOnly = $obj->{'mobileOnly'};

    //преобразуем строковые true / false => булевые true(1) / false()
    $siteIsOn = formatToBool($siteIsOn);
    $filterIp = formatToBool($filterIp);
    $mobileOnly = formatToBool($mobileOnly);

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
function formatToBool($s)
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
