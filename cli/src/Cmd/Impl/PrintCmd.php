<?php


namespace Solyaris\Cmd\Impl;

use Solyaris\App\Config;
use Solyaris\App\IApp;
use Solyaris\App\Option;
use Solyaris\App\Options;
use Solyaris\Cmd\Cmd;
use Solyaris\Cmd\CmdArgsException;
use Solyaris\Cmd\CmdExecException;

class PrintCmd extends Cmd
{
    /**
     * @return Option[]
     */
    public function getOptions(): Options
    {
        return new Options([
            new Option('message', Option::T_STRING, 'послание', 'Привет', 'что сказать Серверу'),
            new Option('sleep', Option::T_NUMBER, 'пауза перед ответом, с', 2, '')
        ]);
    }
    /**
     * @return string
     * @throws CmdExecException
     * @throws CmdArgsException
     */
    public function execute(): string
    {
        $config = $this->getExecConfig();
        $message = $config->get('message');
        $sleep = (int)$config->get('sleep');

        if($this->target instanceof IApp)
            $this->target->writeLn($message);

        sleep($sleep);
        return sprintf("Сообщение '%s' принято сервером", $message);
    }
    /**
     * @param Config $config
     * @throws CmdArgsException
     */
    public function validate(Config $config)
    {
        $message = $config->get('message');
        if(strlen($message) <= 0)
            throw new CmdArgsException("должно быть какое-то сообщение");
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return "Выводит сообщение";
    }
}