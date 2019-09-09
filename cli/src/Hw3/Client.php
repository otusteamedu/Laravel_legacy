<?php

namespace Solyaris\Hw3;

use Exception;
use Solyaris\App\ConsoleApp;
use Solyaris\App\Process;
use Solyaris\Net\Socket;

class Client extends ConsoleApp
{
    /**
     * @var Socket
     */
    private $socket;
    /**
     * @return int
     */
    public function run(): int
    {
        $this->setRunning(true);
        $config = $this->getConfig();
        $sockFile = $config->get('sockFile', '');
        $addressConnect = $config->get('addressConnect', '');
        $portConnect = (int) $config->get('portConnect', 0);

        try {
            if(strlen($sockFile) > 0)
                $this->socket = Socket::createClient($sockFile);
            else
                $this->socket = Socket::createClient($addressConnect, AF_INET, $portConnect);

            $pid = Process::Instance()->getPid();
            $this->socket->Send($pid . PHP_EOL);
            do {
                $buffer = $this->socket->Receive();
                if($buffer === null) {
                    $this->stop();
                    $this->writeLn("Сервер отключился");
                }
                else {
                    $buffer = trim($buffer);
                    if(strlen($buffer) > 0) {
                        $this->writeLn($buffer);
                        $this->socket->Send($buffer . PHP_EOL);
                    }
                }
            }
            while($this->IsRunning());
        }
        catch (Exception $e) {
            $this->writeLn($e->getMessage());
            return 1;
        }

        return 0;
    }
}