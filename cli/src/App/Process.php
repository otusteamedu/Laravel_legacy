<?php

namespace Solyaris\App;

use Exception;

/**
 * Класс, инкапсулирующий процесс. Синглтон
 * Содержит ссылки на ввод-вывод AppIO. 
 * IApp - поток выполнения (процесс однопоточный)
 * Функции обработчики сигналов ОС
 */
final class Process
{
    /**
     * @var IApp
     */
    private $app;
    /**
     * @var AppIO
     */
    private $io;
    /**
     * @var Process
     */
    private static $_instance = null;

    private function __construct(IApp $app, AppIO $io) {
        $this->app = $app;
        $this->io = $io;

        $this->Init();
    }
    /**
     * @param IApp $app
     * @param AppIO $io
     * @return Process
     * @throws Exception
     */
    public static function Create(IApp $app, AppIO $io) : self {
        if(is_null(self::$_instance))
            self::$_instance = new self($app, $io);

        return self::Instance();
    }
    /**
     * @return Process
     */
    public static function Instance() {
        if(is_null(self::$_instance))
            return null;

        return self::$_instance;
    }

    public function Init() {
        pcntl_async_signals(true);

        pcntl_signal(SIGTERM, array($this, 'signalHandler'));
        pcntl_signal(SIGINT, array($this, 'signalHandler'));
        pcntl_signal(SIGHUP, array($this, 'signalHandler'));
        // pcntl_signal(SIGSTOP, array($this, 'signalHandler'));
        // pcntl_signal(SIGUSR1, array($this, 'signalHandler'));
    }

    public function signalHandler($signo) {
        switch ($signo) {
            case SIGINT :
            case SIGTERM :
                $this->app->writeLn('Остановка процесса PID=' . $this->getPid());
                $this->app->stop();
                break;
            case SIGHUP :
                $this->app->writeLn('Перечитываем конфигурацию PID=' . $this->getPid());
                $this->app->reload();
                break;
            default:
                $this->app->writeLn('Типа обрабатываем сигнал ' . $signo . ' в PID=' . $this->getPid());
                // Обработка других сигналов
        }
    }

    public function getIO() : AppIO {
        return $this->io;
    }

    /**
     * Старт приложения внутри процесса.
     * Если процесс нужно запустить как демон, используем промежуточную функцию Fork()
     * @param bool $IsDaemon
     * @return int
     */
    public function start(bool $IsDaemon = false): int {
        if($IsDaemon) {
            if(!$this->isDaemonRunning())
                return $this->Fork();

            $this->app->errorLn('Демон уже запущен. PID = ' . $this->readPid());
            return 1;
        }

        return $this->RunApp();
    }

    private function Fork() : int {
        $pid = pcntl_fork();
        if ($pid == -1) {
            /**
             * Не получилось сделать форк процесса, о чем сообщим в консоль
             */
            $this->app->errorLn('Не удалось породить дочерний процесс');
            return 1;
        }
        elseif ($pid) {
            /**
             * В эту ветку зайдет только родительский процесс, который мы убиваем и сообщаем 
             * об этом в консоль
             */
            // pcntl_wait($status);
            $this->writePid($pid);
            $this->app->errorLn('Демон запущен. Его PID = ' . $pid . PHP_EOL);

            return 0;
        }

        $this->RunApp();

        // не знаю зачем, но в документации ее вызывают
        posix_setsid();

        return 0;
    }

    private function pidFileName() {
        global $argv;
        return getcwd()."/run/".basename($argv[0]).".pid";
    }

    public function getPid(): int {
        if(function_exists('posix_getpid'))
            return posix_getpid();

        return getmypid();
    }

    private function RunApp(): int {
        return $this->app->run();
    }

    private function writePid(int $pid = 0) : void {
        if($pid <= 0)
            $pid = $this->getPid();
        file_put_contents($this->pidFileName(), $pid);
    }

    private function readPid() : int {
        $pidfile = $this->pidFileName();
        if(is_file($this->pidFileName())) {
            return (int) file_get_contents($pidfile);
        }

        return 0;
    }

    private function isDaemonRunning(): bool {
        $runPid = $this->readPid();
        if($runPid == 0)
            return false;

        if(posix_kill($runPid, 0))
            return true;

        if(!@unlink($this->pidFileName()))
            die("Демон не запущен. Ошибка удаления файла " . $this->pidFileName());

        return false;
    }
}
