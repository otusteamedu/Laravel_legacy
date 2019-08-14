<?php
/**
 * Окружение для запуска скриптов в командной строке
 */

namespace Project\Environment;

class Cli extends Base {
    const SCRIPT_NAME_TEMPLATE = '\\Script\\%s';
    private $scriptName;
    private $argumentsRaw;
    /**
     * @var \Project\Dispatcher\Cli
     */
    private $Dispatcher;

    public function getCurrentEnvironment() {
        return \Project\Environments::CLI;
    }

    public function getRawArgs() {
        return $this->argumentsRaw;
    }

    /**
     * @param array $argv - ожидается массив аргументов, пришедший в $argv
     * @throws \RuntimeException
     */
    public function setup($argv = array())
    {
        if (empty($argv[1])) {
            throw new \RuntimeException("You must specify script name in first argument");
        }

        $argv[1] = str_replace('/', '\\', $argv[1]);
        $this->scriptName = sprintf(self::SCRIPT_NAME_TEMPLATE, $argv[1]);

        //притворяемся, что у нас мол есть REMOTE_ADDR
        $_SERVER['REMOTE_ADDR'] = gethostbyname(gethostname());

        //костыль для выделения платформы.
        $argc = count($argv);
        for ($i = 2; $i < $argc; $i++) {
            if ('--platform' == $argv[$i]) {
                if (empty($argv[$i+1])) {
                    throw new \RuntimeException('Empty platform was specified');
                }

                $this->currentPlatform = $argv[$i+1];
                //удаляем аргумент с платформой, чтобы внутри скрипта не было лишнего
                unset ($argv[$i]);
                unset ($argv[$i+1]);
                break;
            }
        }

        if (!$this->currentPlatform) {
            $this->currentPlatform = \Project\Platforms::getInstance()->getCurrentPlatform();
            if (!$this->currentPlatform) {
                throw new \RuntimeException('Unable to determine platform. Run "./build setDefaultPlatform platform=..." to set default platform');
            }
        }

        if (!\Project\Platforms::getInstance()->isValidPlatform($this->currentPlatform)) {
            throw new \RuntimeException('Unknown platform: ' . $this->currentPlatform . '.' . PHP_EOL
            . 'Available platforms are: ' . PHP_EOL . implode(PHP_EOL, \Project\Platforms::getInstance()->getAvailablePlatforms()));
        }

        //удаляем первый аргумент (файл точки входа) и второй - имя запускаемого скрипта.
        //Опять же, чтобы не пугать выполняемый скрипт
        unset($argv[0]);
        unset($argv[1]);

        $this->argumentsRaw = array_values($argv);
    }

    /**
     * @return \Project\Dispatcher\Cli
     */
    protected function getDispatcher()
    {
        if (empty($this->Dispatcher)) {
            $this->Dispatcher = new \Project\Dispatcher\Cli();
            $this->Dispatcher->setEnvironment($this);
            $this->Dispatcher->setup($this->scriptName);
        }

        return $this->Dispatcher;
    }
}