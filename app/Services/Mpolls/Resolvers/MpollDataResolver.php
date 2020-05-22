<?php


namespace App\Services\Mpolls\Resolvers;


use Auth;

class MpollDataResolver
{

    public function resolve($data)
    {
        $data['price'] = 5.5;
//        $data['vvvvv'] = 5.5;
        $data['created_user_id'] = Auth::user()->id;
        return $data;
    }
}
