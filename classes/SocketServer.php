<?php

class SocketServer {

    private $host;
    private $port;
    private $maxByteForRead;
    private $protocolFamilyForSocket;
    private $typeOfDataExchange;
    private $protocol;
    private $logger;

    public function __construct(ServerSocketDataBuilder $builder, LogInterface $logger) {
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

    public function socketBind($socket) {
        $bind = socket_bind($socket, $this->host, $this->port);
        if (!$bind) {
            $this->logger->log('Не получилось связать дискриптор сокета с адресом и портом');
            throw new SocketException('Не получилось связать дискриптор сокета с адресом и портом');
        }
        return $bind;
    }

    public function listen($socket) {
        $phone = socket_listen($socket, 5);
        if (!$phone) {
            $this->logger->log('Ошибка при попытке прослушивания сокетам');
            throw new SocketException('Ошибка при попытке прослушивания сокета');
        }
        return $phone;
    }

    public function startConnectionWithSocket($socket) {
        $socketConnection = socket_accept($socket);
        if (!$socketConnection) {
            $this->logger->log('Ошибка при старте соединений с сокетом');
            throw new SocketException('Ошибка при старте соединений с сокетом');
        }
        return $socketConnection;
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

