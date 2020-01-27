<?php


namespace App\Http\Controllers\Subscription;


class WriteFileForm
{
    static function save($data)
    {
        $fd = fopen("hello.txt", 'w');
        fwrite($fd, $data);
        fclose($fd);
    }

    public function getAge($data)
    {
        if
    }
}
