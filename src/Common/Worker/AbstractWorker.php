<?php

namespace App\Common\Worker;

use App\Common\Config\Config;

/**
 * Абстрактный класс реализующий задачу, которая может выполняться пошагово
 */

abstract class AbstractWorker implements IWorkerTask
{
    /**
     * постоянная конфигурация, вход через конструктор
     * 
     * @var Config постоянная конфигурация воркера 
     */
    private $config; 

    /**
     * динамическое состояние задачи, которое необходимо сохранять после цикла 
     * и восстанавливать перед следующим циклом итераций
     * 
     * @var Config динамическое состояние задачи
     */
    private $state; 

    /**
     * текущий шаг
     * 
     * @var int массив воркеров 
     */
    private $current;

    /**
     * признак произошедшей ошибки в ходе выполнения или инициализации
     * 
     * @var bool
     */    
    private $bError;

    /**
     * описание текущего выполненного действия или возникшей ошибки
     * 
     * @var string
     */   
    private $message;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->state = new Config;
        $this->current = 0;
        $this->bError = false;
        $this->message = "";
    }

    protected function setError(bool $value) {
        $this->bError = $value;
    }

    public function IsError() : bool {
        return $this->bError;
    }

    public function IsDone() : bool {
        return !$this->IsError() && ($this->getCurrent() >= $this->getTotal());
    }

    /**
     * @param string $message
     */
    protected function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string $message
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    public function getConfig() : Config {
        return $this->config;
    }

    public function getState() : Config {
        return $this->state;
    }

    public function getCurrent() : int {
        return $this->current;
    }

    protected function setCurrent(int $current)
    {
        $this->current = $current;
    }

    public function getPercentage() : float {
        $total = $this->getTotal();
        if($total <= 0)
            return 0.00;
        return $this->getCurrent() / $this->getTotal() * 100;
    }

    // ряд функций может быть пустыми и никогда не меняться
    public function initSession() {
    }

    public function finishSession() {
    }

    public function init(Config $state, int $current) 
    {
        $this->state = $state;
        $this->current = $current;
    }

    public function finish() : Config {
        return $this->state;
    }

    // эти функции всегда будут разные, поэтому
    // оставляемих как абстрактные 
    abstract public function doAction();
    abstract public function getTotal() : int;
}