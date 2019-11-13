<?php


namespace Hw7;


interface ClientInterface
{
    public function read(callable $callable);
}