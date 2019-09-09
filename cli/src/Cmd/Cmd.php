<?php


namespace Solyaris\Cmd;


use mysql_xdevapi\Exception;
use Solyaris\App\Config;

abstract class Cmd implements ICmd
{
    protected $config;
    protected $target;

    /**
     * Cmd constructor.
     * @param $target
     */
    final public function __construct($target)
    {
        $this->config = new Config();
        $this->target = $target;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config {
        return $this->config;
    }
    /**
     * @throws CmdArgsException
     */
    final protected function getExecConfig(): Config {
        $config = $this->getOptions()->getDefault()->merge($this->getConfig());
        $this->validate($config);
        return $config;
    }

    public function getParam($name, $default = '') {
        return $this->getConfig()->get($name, $default);
    }
    public function setParam($name, $value = null) {
        return $this->getConfig()->set($name, $value);
    }
    /**
     * @return string
     */
    public function getId(): string
    {
        $name = get_class($this);
        $pos = strrpos($name, "\\");
        if($pos !== false)
            $name = substr($name, $pos + 1);
        $parent = get_parent_class($this);
        $pos = strrpos($parent, "\\");
        if($pos !== false)
            $parent = substr($parent, $pos + 1);

        $pos = strpos($name, $parent);
        if($pos > 0) {
            $name = substr($name, 0, $pos);
        }
        else {
            $pos = strpos($name, "_");
            if($pos > 0)
                $name = substr($name, 0, $pos);
        }

        $name = trim($name, " _");
        $name = \strtolower($name);

        return strtolower($name);
    }
}