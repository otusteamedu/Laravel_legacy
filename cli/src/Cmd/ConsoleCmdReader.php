<?php

namespace Solyaris\Cmd;

use Solyaris\App\IApp;

class ConsoleCmdReader implements ICmdReader
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
    /**
     * @return ICmd|null
     * @throws CmdReaderException
     */
    public function read(): ?ICmd {
        $this->app->write("Ваша команда > ");
        $cmdId = $this->app->readLn();
        if($cmdId === '')
            return null;
        $dispatcher = $this->app->getCmdDispatcher();
        $cmdObject = $dispatcher->get($cmdId);

        if(!$cmdObject)
            throw new CmdReaderException("Команда ". $cmdId . " не найдена");

        $options = $cmdObject->getOptions()->getData();
        foreach ($options as $option) {
            $msg = " - " . $option->getName() . " ";
            if(strlen($option->getHint()) > 0)
                $msg .= "(".$option->getHint().") ";
            $msg .= "[".$option->getDefault()."] :";

            $this->app->write($msg);
            $value = $this->app->readLn();

            if(!empty($value))
                $cmdObject->setParam($option->getId(), $value);
        }

        return $cmdObject;
    }
}