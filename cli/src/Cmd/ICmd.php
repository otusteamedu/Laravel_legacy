<?php
namespace Solyaris\Cmd;

use Solyaris\App\Config;
use Solyaris\App\Options;

interface ICmd
{
    /**
     * @return Options
     */
    public function getOptions() : Options;
    /**
     * @return Config
     */
    public function getConfig() : Config;

    /**
     * @param Config $config
     */
    public function validate(Config $config);
    /**
     * @return string
     * @throws CmdExecException
     * @throws CmdArgsException
     */
    public function execute() : string;
    /**
     * Уникальный ID. Можно получить до создания объекта
     *
     * @return string
     */
    public function getId() : string;
    /**
     * Выводимое имя. Можно получить до создания объекта
     *
     * @return string
     */
    public function getName() : string;
}