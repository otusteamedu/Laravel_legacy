<?php


namespace Solyaris\Cmd;


use Solyaris\App\IApp;

class SocketCmdReader implements ICmdReader
{
    /**
     * @var IApp
     */
    private $app;
    /**
     * ConsoleCmdReader constructor.
     * @param IApp $app
     */
    public function __construct(IApp $app) {
        $this->app = $app;
    }

    public function read(): ?ICmd
    {
        // TODO: Implement read() method.
    }
}