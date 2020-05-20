<?php

namespace Socket;

class App
{
    const SOCKET_FILE = "/tmp/otus_hw3.sock";
    const MESSAGE_TIMEOUT = 3;
    const MESSAGE_MAX_LENGTH_BYTES = 4096;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $Logger)
    {
        $this->logger = $Logger;
        error_reporting(E_ERROR);
    }

    public function runServer()
    {
        $server = new Server(self::SOCKET_FILE, $this->logger);
        $server->run();
    }

    public function runClient()
    {
        $client = new Client(self::SOCKET_FILE, $this->logger);
        $client->run();
    }
}
