<?php

namespace Solyaris\Hw3;

use Exception;
use Solyaris\App\ConsoleApp;
use Solyaris\Net\SelectedConn;
use Solyaris\Net\SelectedPool;
use Solyaris\Net\Socket;

/**
 * Стартует сервер, слушает
 *
 * Class Server
 * @package Solyaris\Hw3
 */
class Server extends ConsoleApp {
    /**
     * Период отправки сообщений клиенту, с
     */
    const PERIOD = 2;
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
        $addressBind = $config->get('addressBind', '');
        $portBind = (int) $config->get('portBind', 0);
        $selectedPool = null;
        $sysResult = 0;

        if(is_file($sockFile))
            unlink($sockFile);

        try {
            if(strlen($sockFile) > 0)
                $this->socket = Socket::createServer($sockFile);
            else
                $this->socket = Socket::createServer($addressBind, AF_INET, $portBind);

            $selectedPool = (new SelectedPool($this->socket))
                // от клиента придет PID (мы с ним договорились).
                // Сохраним его и выведем сообщние в поток вывода
                ->onNew(function(SelectedConn $connection)
                {
                    $data = $connection->getSocket()->Receive();
                    $clientPid = (int) trim($data);
                    $connection->set('pid', $clientPid);
                    $connection->set('time', time());
                    $this->writeLn(
                        sprintf("Новое соединение. PID=%d", (int) $clientPid)
                    );
                })
                ->onClose(function(SelectedConn $connection) {
                    $this->writeLn(
                        sprintf("Клиент с PID=%d отключился", (int) $connection->get('pid'))
                    );
                })
                ->onRead(function(SelectedConn $connection, string $data) {
                    $this->writeLn(
                        sprintf("Сообщение '%s' принято клиентом ID=%d\n", $data, (int) $connection->get('pid'))
                    );
                })
                ->onTeak(function(SelectedConn $connection) {
                    if(time() - (int)$connection->get('time') > self::PERIOD) {
                        $data = $this->getRandString();
                        $connection->getSocket()->Send($data . PHP_EOL);
                        $this->writeLn(
                            sprintf("Клиенту с PID=%d отправлено '%s'" , (int)$connection->get('pid') , $data)
                        );
                        $connection->set('time', time());
                    }
                });

            do {
                $selectedPool->poll();
            }
            while($this->IsRunning());
        }
        catch (Exception $e) {
            $this->errorLn($e->getMessage());
            $sysResult = 1;
        }
        finally {
            if($selectedPool) {
                $selectedPool->closeAll();

                if(file_exists($sockFile))
                    @unlink($sockFile);
            }
        }

        return $sysResult;
    }

    private function getRandString() {
        $length = rand(12, 24);
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $len = strlen($string);
        $result = "";
        for($i = 0; $i < $length; $i++) {
            $x = rand(0, $len - 1);
            $result[$i] = $string[$x];
        }
        return $result;
    }
}
