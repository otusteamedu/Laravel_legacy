<?php


namespace Solyaris\App;

use Exception;
use Solyaris\Cmd\CmdArgsException;
use Solyaris\Cmd\CmdDispatcher;
use Solyaris\Cmd\CmdExecException;
use Solyaris\Cmd\CmdReaderException;
use Solyaris\Cmd\ConsoleCmdReader;
use Solyaris\Cmd\ICmd;
use Solyaris\Cmd\ICmdDispatcher;

class ConsoleApp implements IApp
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var string
     */
    private $configFile;
    /**
     * @var CmdDispatcher
     */
    private $cmdDispatcher;
    /**
     * @var bool
     */
    private $bRunApp;
    /**
     * ConsoleApp constructor.
     * @param string $configFile
     * @param ICmdDispatcher $dispatcher
     */
    public function __construct(string $configFile, ICmdDispatcher $dispatcher)
    {
        $this->cmdDispatcher = $dispatcher;
        $this->cmdDispatcher->setTarget($this);

        $this->configFile = $configFile;
        $this->config = new Config();

        $this->init();
    }

    protected function init() {
        $this->readConfig($this->configFile);
    }

    public function write(string $string): void {
        if(!$inst = Process::Instance())
            return;
        $inst->getIO()->write($string);
    }

    public function writeLn(string $string): void {
        if(!$inst = Process::Instance())
            return;
        $inst->getIO()->writeLn($string);
    }

    public function error(string $string): void {
        if(!$inst = Process::Instance())
            return;
        $inst->getIO()->error($string);
    }

    public function errorLn(string $string): void {
        if(!$inst = Process::Instance())
            return;
        $inst->getIO()->errorLn($string);
    }

    public function read(int $length = 0): ?string {
        if(!$inst = Process::Instance())
            return null;
        return $inst->getIO()->read();
    }

    public function readLn(): ?string {
        if(!$inst = Process::Instance())
            return null;
        return $inst->getIO()->readLn();
    }

    public function getConfig(): Config {
        return $this->config;
    }

    public function readConfig(string $filePath): void {
        $data = is_file($filePath) ? parse_ini_file($filePath) : [];
        $this->config = new Config();

        if(is_array($data)) {
            foreach ($data as $key => $value) {
                $this->config->set($key, $value);
            }
        }
    }
    /**
     * @return bool
     */
    public function IsRunning(): bool {
        return $this->bRunApp;
    }
    /**
     * @param bool $bRunApp
     * @return bool
     */
    public function setRunning(bool $bRunApp): bool {
        $this->bRunApp = $bRunApp;
        return $this->bRunApp;
    }
    /**
     *
     */
    public function stop(): void {
        $this->setRunning(false);
    }
    /**
     * 
     */
    public function reload(): void {
        $this->readConfig($this->configFile);
    }
    /**
     * Получаем команду ICmd, выполняем ее, получаем, выполняем, получаем, выполняем...
     * Остановиться можно только внешним сигналом или получением пустой команды
     *
     * @return int
     * @throws Exception
     */
    public function run(): int
    {
        $this->setRunning(true);
        $helpMessage = $this->getCmdDispatcher()->printHelp();
        $this->writeLn($helpMessage);

        do {
            try {
                $cmd = $this->peakCmd();
                if(is_null($cmd))
                    $this->stop();
                if($this->IsRunning()) {
                    $this->executeCmd($cmd);
                }
            }
            catch(CmdReaderException $e) {
                $this->writeLn($e->getMessage());
            }
            catch(CmdArgsException $e) {
                $this->writeLn($e->getMessage());
            }
            catch(CmdExecException $e) {
                $this->writeLn($e->getMessage());
            }
            catch(Exception $e) {
                $this->handleUserException($e);
            }
        }
        while($this->IsRunning());

        return 0;
    }
    /**
     * @return ICmd|null
     * @throws CmdReaderException
     */
    protected function peakCmd(): ?ICmd {
        $reader = new ConsoleCmdReader($this);
        return $reader->read();
    }
    /**
     * @param ICmd $cmd
     * @throws CmdExecException
     * @throws CmdArgsException
     */
    protected function executeCmd(ICmd $cmd) {
        $result = $cmd->execute();
        $message = "Результат: " . $result . PHP_EOL;
        $this->writeLn($message);
    }

    /**
     * @param Exception $e
     */
    protected function handleUserException(Exception $e) {
        $this->writeLn("Ошибка: " . $e->getMessage());
    }

    public function getCmdDispatcher() : ICmdDispatcher {
        return $this->cmdDispatcher;
    }
}