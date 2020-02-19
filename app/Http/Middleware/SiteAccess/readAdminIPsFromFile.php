<?php

function getAdminIPs()
{
    $fileName="adminIPs.json";// файл, со списком админовских ip
    $fileUrl=dirname(__FILE__)."/".$fileName;
    $str = file_get_contents($fileUrl);//считай файл и всё его содержимое передай в строку
    $obj = json_decode($str);
    $admin_ips = $obj->{'admin_ips'};
    return $admin_ips;
}
