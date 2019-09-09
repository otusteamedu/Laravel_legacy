<?php


namespace Solyaris\Cmd;


use Solyaris\App\IApp;

class SocketCmdWriter implements ICmdWriter
{
    /**
     * @var IApp
     */
    private $app;
    /**
     * SocketCmdWriter constructor.
     * @param IApp $app
     */
    public function __construct(IApp $app) {
        $this->app = $app;
    }

    public function write(ICmd $cmd): void
    {
        // TODO: Implement write() method.
    }
}