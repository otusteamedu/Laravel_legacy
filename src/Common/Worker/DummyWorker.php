<?php

namespace App\Common\Worker;

use App\Common\Config\Config;

class DummyWorker extends AbstractWorker {
    public function doAction() {
        $currentStep = $this->getCurrent();

        $taskComplexity = rand(4, 8);
        \sleep($taskComplexity);

        $this->getState()->set('Iteration_'.$this->getCurrent(), $taskComplexity);
        $this->setMessage("Dummy шаг $currentStep выполнен. taskComplexity = " . $taskComplexity);

        $this->setCurrent($currentStep + 1);
    }

    public function getTotal() : int {
        return (int) $this->getState()->get('total');
    }

    public function initSession(): bool {
        $this->getState()->set('total', \rand(
            $this->getConfig()->get('min', 10),
            $this->getConfig()->get('max', 40)
        ));
        $this->getState()->set('SessionVar', 'initSessionDummy');
        $this->getState()->set('SessionVarDelete', 'initSessionDummyDelete');

        return true;
    }

    public function init(Config $state, int $current) : bool
    {
        parent::init($state, $current);
        $this->getState()->set('CircleInStep_'.$this->getCurrent(), 1);
        return true;
    }

    public function finish() : Config {
        $this->getState()->set('CircleInOut'.$this->getCurrent(), 1);
        return parent::finish();
    }

    public function finishSession() {
        $this->getState()->set('SessionVarDelete');
    }
}