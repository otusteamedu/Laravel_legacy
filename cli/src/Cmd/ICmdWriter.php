<?php

namespace Solyaris\Cmd;

interface ICmdWriter
{
    public function write(ICmd $cmd): void;
}