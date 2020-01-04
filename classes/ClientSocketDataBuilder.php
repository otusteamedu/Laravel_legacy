<?php

require __DIR__ . '/SocketLogger.php';
require __DIR__ . '/SocketClient.php';

class ClientSocketDataBuilder {

    private $host;
    private $port;
    private $maxByteForRead;
    private $protocolFamilyForSocket;
    private $typeOfDataExchange;
    private $protocol;
    private $error;

    public function setHost($host) {
        $this->host = $host;
        return $this;
    }
    public function setPort($port) {
        $this->port = $port;
        return $this;
    }

    public function setMaxByteForRead($maxByteForRead) {
        $this->maxByteForRead = $maxByteForRead;
        return $this;
    }
    public function setProtocolFamilyForSocket($protocolFamilyForSocket) {
        $this->protocolFamilyForSocket = $protocolFamilyForSocket;
        return $this;
    }

    public function setTypeOfDataExchange($typeOfDataExchange) {
        $this->typeOfDataExchange = $typeOfDataExchange;
        return $this;
    }

    public function setProtocol($protocol) {
        $this->protocol = $protocol;
        return $this;
    }

    public function built() {
        $this->validate();
        if (!empty($this->error)) {
            throw new \RuntimeException(implode(';' , $this->error));
        }
        return new SocketClient($this, new SocketLogger());
    }
    private function validate() {

        if (empty($this->host)) {
            $this->error[] = 'Не передан хост';
        }

        if (empty($this->port)) {
            $this->error[] = 'Не передан порт';
        }

        if (empty($this->maxByteForRead)) {
            $this->error[] = 'Не задано максимальное количество байт для чтения';
        }

        if (!is_numeric($this->maxByteForRead)) {
            $this->error[] = 'Максимальное количество байт для чтения должно быть числом';
        }

        if (empty($this->protocolFamilyForSocket)) {
            $this->error[] = 'Не задано семейство протоколов, используемых сокетами';
        }

        if (!is_numeric($this->protocolFamilyForSocket)) {
            $this->error[] = 'семейство протоколов, используемых сокетами должно быть числом';
        }

        if (empty($this->typeOfDataExchange)) {
            $this->error[] = 'Не задан тип обмена данными, который будет использоваться сокетом';
        }

        if (!is_numeric($this->typeOfDataExchange)) {
            $this->error[] = 'Тип обмена данными, который будет использоваться сокетом должно быть числом';
        }

        if (empty($this->protocol)) {
            $this->error[] = 'Не задан конкретный протокол в заданном семействе протоколов';
        }

        if (!is_numeric($this->protocol)) {
            $this->error[] = 'Протокол должен быть числом';
        }

    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function getMaxByteForRead() {
        return $this->maxByteForRead;
    }

    public function getProtocolFamilyForSocket() {
        return $this->protocolFamilyForSocket;
    }

    public function getTypeOfDataExchange() {
        return $this->typeOfDataExchange;
    }

    public function getProtocol() {
        return $this->protocol;
    }

}
