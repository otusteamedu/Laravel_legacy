<?php

namespace App\Common\Worker;

/**
 * Текущее состояние выполняемых задач
 * Используется только в классе TaskManager
 *
 * Class TaskProcessState
 * @package App\Common\Worker
 */

use App\Common\Config\Config;

final class TaskProcessState {
    /**
     * текущий воркер
     */
    private $n_worker;

    /**
     * текущий шаг в текущем воркере
     */
    private $n_current;

    /**
     * время начала сессии, с (UNIX)
     */
    private $tmSessionStart;

    /**
     * время начала текущей задачи (UNIX)
     */
    private $tmWorkerStart;

    /**
     * время последнего выполнения цикла итераций текущей задачи (UNIX)
     */
    private $tmWorkerUpdate;

    /**
     * цикл итераций завершен с ошибкой
     */
    private $bError;

    /**
     * описание последней итерации цикла, либо ошибки
     */
    private $strMessage;

    /**
     * последнее состояние воркера
     */
    private $workerState;

    public function __construct() {
        $this->n_worker = 0;
        $this->n_current = 0;
        $this->tmSessionStart = 0;
        $this->tmWorkerStart = 0;
        $this->tmWorkerUpdate = 0;
        $this->bError = false;
        $this->strMessage = "";
        $this->workerState = new Config;
    }

    public function getWorker() : int { 
        return $this->n_worker; 
    }

    public function setWorker(int $value) : self { 
        $this->n_worker = $value;
        return $this;
    }

    public function getCurrent() : int { 
        return $this->n_current; 
    }

    public function setCurrent(int $value) : self { 
        $this->n_current = $value;
        return $this;
    }

    public function getSessionStartAt() : int { 
        return $this->tmSessionStart; 
    }
    
    public function setSessionStartAt(int $value) : self { 
        $this->tmSessionStart = $value;
        return $this;
    }

    public function getWorkerStartAt() : int { 
        return $this->tmWorkerStart; 
    }

    public function setWorkerStartAt(int $value) : self { 
        $this->tmWorkerStart = $value;
        return $this;
    }

    public function getWorkerUpdateAt() : int { 
        return $this->tmWorkerUpdate; 
    }

    public function setWorkerUpdateAt(int $value) : self { 
        $this->tmWorkerUpdate = $value;
        return $this;
    }

    public function getDate(string $type, string $format) {
        $time = 0;
        switch($type) {
            case 'sess-start':
                $time = $this->getSessionStartAt();
                break;
            case 'worker-start':
                $time = $this->getWorkerStartAt();
                break;
            case 'worker-update':
                $time = $this->getWorkerUpdateAt();
                break;
        }

        $date = new \DateTime();
        $date->setTimestamp($time);

        return $date->format($format);
    }

    public function IsError() : int { 
        return $this->bError; 
    }

    public function setError(bool $value) : self { 
        $this->bError = $value;
        return $this;
    }

    public function getMessage() : string { 
        return $this->strMessage; 
    }

    public function setMessage(string $value) : self { 
        $this->strMessage = $value;
        return $this;
    }

    public function getWorkerState() : Config { 
        return $this->workerState; 
    }

    public function setWorkerState(Config $value) : self { 
        $this->workerState = $value;
        return $this;
    }
}
