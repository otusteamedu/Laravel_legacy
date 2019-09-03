<?php

class SocketClient {

    private $host;
    private $port;
    private $maxByteForRead;
    private $protocolFamilyForSocket;
    private $typeOfDataExchange;
    private $protocol;
    private $logger;

    public function __construct(ClientSocketDataBuilder $builder, LogInterface $logger) {
        $this->host = $builder->getHost();
        $this->port = $builder->getPort();
        $this->maxByteForRead = $builder->getMaxByteForRead();
        $this->protocolFamilyForSocket = $builder->getProtocolFamilyForSocket();
        $this->typeOfDataExchange = $builder->getTypeOfDataExchange();
        $this->protocol = $builder->getProtocol();
        $this->logger = $logger;
    }

    public function socketCreate() {
        $socket = socket_create($this->protocolFamilyForSocket, $this->typeOfDataExchange, $this->protocol);
        if (!$socket) {
            $this->logger->log('Ошибка создания сокета');
            throw new SocketException('Ошибка создания сокета');
        }
        return $socket;
    }

    public function connect($socket) {
        $connection = socket_connect($socket, $this->host, $this->port);
        if (!$connection) {
            $this->logger->log('Ошибка подключения');
            throw new SocketException('Ошибка подключения');
        }
        return $socket;
    }

    public function read($socket) {
        return socket_read($socket, $this->maxByteForRead);
    }

    public function write($socket, $msg) {
        socket_write($socket, $msg, mb_strlen($msg, 'cp1251'));
    }

    public function socketClose($socket) {
        socket_close($socket);
    }
}

