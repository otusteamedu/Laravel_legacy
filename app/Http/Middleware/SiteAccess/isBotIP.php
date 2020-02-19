<?php
function isBotIP($ip)
{
    // Источник : http://www.liamdelahunty.com/tips/php_gethostbyaddr_googlebot.php

    // Получи имя хоста, с которого был заход на сайт.
    // Боты заходят с хостов **googlebot.com, **yandex.ru, **yandex.com, **yandex.net
    $name = gethostbyaddr($ip);

    // поиск слова Googlebot, yandex.ru, yandex.net, yandex.com в имени хоста $name
    // флаг i - регистронезависимый поиск совпадения
    // 1 - совпало, 0 - не совпало.
    $pm1 = preg_match("/Googlebot/i",$name);
    $pm2 = preg_match("/yandex.ru/i",$name);
    $pm3 = preg_match("/yandex.com/i",$name);
    $pm4 = preg_match("/yandex.net/i",$name);
    $pm = $pm1 OR $pm2 OR $pm3 OR $pm4;

    if($pm)
    {
        $result=true;
    }
    else
    {
        $result=false;
    }

    return $result;
}
