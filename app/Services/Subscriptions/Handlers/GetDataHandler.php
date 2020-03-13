<?php


namespace App\Services\Subscriptions\Handlers;


class GetDataHandler
{
    public function handle()
    {
        $data = file_get_contents('public/hello.txt');
        return $data;
    }
}
