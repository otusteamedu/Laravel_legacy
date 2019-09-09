<?php


namespace Solyaris\Cmd\Impl;


use Solyaris\App\Config;
use Solyaris\App\Options;
use Solyaris\Cmd\Cmd;
use Solyaris\Cmd\CmdArgsException;
use Solyaris\Cmd\CmdExecException;

class DateCmd extends Cmd
{
    /**
     * @return Options
     */
    public function getOptions(): Options {
        return new Options([]);
    }
    /**
     * @param Config $config
     * @throws CmdArgsException
     */
    public function validate(Config $config)  {
    }

    /**
     * @return string
     * @throws CmdExecException
     * @throws CmdArgsException
     */
    public function execute(): string {
        return date("d.m.Y H:i:s");
    }
    /**
     * @return string
     */
    public function getName(): string {
        return "Получить дату на сервере";
    }
}