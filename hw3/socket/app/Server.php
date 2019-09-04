<?php

namespace App;

use Socket\Raw\Exception;
use Socket\Raw\Factory;
use Socket\Raw\Socket;

class Server implements SocketInterface
{
    private $socket;
    private $socketFile;
    private $logger;

    public function __construct($socketFile, LoggerInterface $logger)
    {
        $this->socketFile = $socketFile;
        $this->logger     = $logger;
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
     * Create socket server
     *
     * @return \Socket\Raw\Socket
     */
    public function create(): Socket
    {
        $socketAddress = $this->getSocketAddress();
        $this->logger->message("Начинается запуск сервера {$socketAddress}");

        if (file_exists($this->socketFile)) {
            unlink($this->socketFile);
        }

        try {
            $factory = new Factory();
            $server  = $factory->createServer($socketAddress);
        } catch (Exception $exception) {
            $this->logger->message("Не получилось запустить сервер {$socketAddress} из-за ошибки:");
            die($exception->getMessage().PHP_EOL);
        }

        $this->logger->message('Сервер запущен');
        $this->logger->message('Ожидаю соединения с клиентом');

        return $server;
    }

    /**
     * Close socket server
     */
    public function close(): void
    {
        $socketAddress = $this->getSocketAddress();
        $this->logger->message("Сервер {$socketAddress} остановлен");
        $this->socket->close();
    }

    /**
     * Run socket server
     */
    public function run(): void
    {
        $this->socket = $this->create();

        while ($client = $this->socket->accept()) {
            try {
                $client->bind($this->socket);
                $client->connect($this->socket);
            } catch (Exception $exception) {
                $this->logger->message('Не получилось соединиться с клиентом из-за ошибки:');
                $this->logger->message($exception->getMessage().PHP_EOL);
                $this->logger->message('Ожидаю соединения с клиентом');

                break;
            }

            $clientLogPrefix = 'Клиент';
            $this->logger->message('Соединился с клиентом');

            while (true) {
                try {
                    $serverMessage = $this->generateRandomMessage();
                    $client->write($serverMessage);
                    $clientResponse = $client->read(8192);

                    if ('Принято' === $clientResponse) {
                        $this->logger->message("Сообщение \"{$serverMessage}\" принято", $clientLogPrefix);
                    } else {
                        $this->logger->message("Сообщение \"{$serverMessage}\" не было доставлено", $clientLogPrefix);
                        $this->logger->message('Соединение разорвано', $clientLogPrefix);
                        $this->logger->message('Ожидаю соединения с клиентом');
                        $client->close();

                        break;
                    }
                } catch (Exception $exception) {
                    $this->logger->message('Не получилось отправить сообщение клиенту из-за ошибки:', $clientLogPrefix);
                    $this->logger->message($exception->getMessage(), $clientLogPrefix);
                    $this->logger->message('Ожидаю соединения с клиентом');

                    break;
                }

                sleep(App::getPingPongTimeout());
            }
        }

        $this->close();
    }

    /**
     * Generate random message
     *
     * @return string
     */
    public function generateRandomMessage(): string
    {
        $randomMessage = time();

        try {
            $randomMessage /= random_int(2, 10);
        } catch (\Exception $exception) {
            $this->logger->message($exception->getMessage().PHP_EOL);
        }

        return $randomMessage;
    }
}