<?php


namespace App\Services\Subscriptions\Handlers;


class WriteFileHandler
{
    public function handle($data)
    {
        $path = '/home/vagrant/sites/otus/public/hello.txt';
        $fd = fopen($path, 'w+');
        fwrite($fd, $data);
        fclose($fd);
        echo "Запись выполнена";
    }
}
