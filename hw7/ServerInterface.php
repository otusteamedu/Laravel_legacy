<?php


namespace Hw7;


interface ServerInterface
{
    public function listen(callable $send, callable $replay);
}