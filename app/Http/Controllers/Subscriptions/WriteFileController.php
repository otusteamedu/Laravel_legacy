<?php

namespace App\Http\Controllers\Subscriptions;


class WriteFileController
{
    public static function writeFile($data)
    {
        $fd = fopen("hello.txt", 'a+');
        fwrite($fd, $data['email']. PHP_EOL);
        fclose($fd);
        echo "Запись выполнена";
    }
}
