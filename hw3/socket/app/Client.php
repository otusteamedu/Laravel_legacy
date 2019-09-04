<?php

namespace App;

use Socket\Raw\Exception;
use Socket\Raw\Factory;
use Socket\Raw\Socket;

class Client implements SocketInterface
{
    private $socket;
    private $socketFile;
    private $logger;

    public function __construct($socketFile, LoggerInterface $logger)
    {
        $this->socketFile = $socketFile;
        $this->logger = $logger;
    }

    /**
     * Get unix socket address
     *
     * @return string
     */
    public function getSocketAddress(): string
    {
        return sprintf('unix://%s', $this->socketFile);
    }

    /**
     * Create socket client
     *
     * @return \Socket\Raw\Socket
     */
    public function create(): Socket
    {
        $socketAddress = $this->getSocketAddress();
        $this->logger->message("Соединяюсь с сервером {$socketAddress}");

        try {
            $factory = new Factory();
            $client  = $factory->createClient($socketAddress);
        } catch (Exception $exception) {
            $this->logger->message("Не получилось соединиться с сервером {$socketAddress} из-за ошибки:");
            die($exception->getMessage().PHP_EOL);
        }

        $this->logger->message('Соединение установлено');

        return $client;
    }

    /**
     * Close socket client
     */
    public function close(): void
    {
        $this->logger->message('Соединение с сервером разорвано');
        $this->socket->close();
    }

    /**
     * Run socket client
     */
    public function run(): void
    {
        $this->socket = $this->create();

        while ($message = $this->socket->read(8192)) {
            $this->logger->message("Сообщение от сервера: \"{$message}\"");
            $this->socket->write('Принято');
        }

        $this->close();
    }
}