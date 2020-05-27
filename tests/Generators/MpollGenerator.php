<?php


namespace Tests\Generators;


use App\Models\Mpoll;

class MpollGenerator
{

    public static function createMpoll(array $data = [])
    {
        return factory(Mpoll::class)->create($data);
    }

}
