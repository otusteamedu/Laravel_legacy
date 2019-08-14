<?php


namespace App\Common\Worker;


interface ITaskManager
{
    public function addWorker(IWorkerTask $worker, $nWeight = 1) : ITaskManager;
    public function process() : bool;
    public function getSessionId() : string;
    // public function setSessionId(string $session_id);

    public function getPercentage() : float;
    public function getMessage() : string;
}