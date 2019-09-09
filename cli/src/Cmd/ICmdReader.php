<?php

namespace Solyaris\Cmd;

interface ICmdReader
{
    public function read() : ?ICmd;
}