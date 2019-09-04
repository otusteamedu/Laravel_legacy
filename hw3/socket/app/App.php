<?php

namespace App;

use Dotenv\Dotenv;

class App
{
    private const SOCKET_FILE = '/tmp/daemon.sock';
    private const MESSAGE_TIMEOUT = 1;

    private $socketFile;
    private $logger;

    public function __construct()
    {
        $this->socketFile = $this->getSocketFile();
    }

    /**
     * Tasks before app run
     */
    public function boot(): void
    {
        $dotenv = Dotenv::create(__DIR__.'/../');
        $dotenv->load();

        $this->logger = new Logger();
    }

    /**
     * Get socket file path from .env
     *
     * @return string
     */
    function getSocketFile()
    {
        return getenv('SOCKET_FILE') ?: self::SOCKET_FILE;
    }

    /**
     * Return socket server
     */
    public function runServer(): void
    {
        $this->boot();

        $server = new Server($this->socketFile, $this->logger);

        $server->run();
    }

    /**
     * Run socket client
     */
    public function runClient(): void
    {
        $this->boot();

        $server = new Client($this->socketFile, $this->logger);

        $server->run();
    }

    /**
     * Get ping-pong timeout from .env
     *
     * @return int
     */
    public static function getPingPongTimeout(): int
    {
        $pingPongTimeout = getenv('PING_PONG_TIMEOUT');

        if (!$pingPongTimeout || (int)$pingPongTimeout < 1) {
            return self::MESSAGE_TIMEOUT;
        }

        return (int) $pingPongTimeout;
    }
}