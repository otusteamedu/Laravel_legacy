<?php


namespace App\Services\Mpolls\Resolvers;


class MpollDataResolver
{

    public function resolve($data)
    {
        $data['price'] = 5.5;
        return $data;
    }
}
