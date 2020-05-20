<?php

namespace Socket;

abstract class AbstractUnixSocket
{
    protected $socket;
    protected $socketFile;
    /**
     * @var LoggerInterface
     */
    protected $Logger;

    public function __construct($socketFile, LoggerInterface $Logger)
    {
        $this->socketFile = $socketFile;
        $this->Logger = $Logger;
    }

    protected function getSocketAddress()
    {
        return sprintf("unix://%s", $this->socketFile);
    }

    abstract public function run();
    abstract public function close();
}
