<?php


namespace Solyaris\Cmd;


interface ICmdDispatcher
{
    /**
     * @param string $id
     * @param $target
     * @return ICmd
     */
    public function get(string $id) : ?ICmd;

    /**
     * @return array of string ICmd:class
     */
    public function getList(): array;

    /**
     * @return void
     */
    public function printHelp(): string;
}