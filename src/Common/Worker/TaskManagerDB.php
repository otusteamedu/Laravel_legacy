<?php

namespace App\Common\Worker;

/**
 * Пошаговое выполнение с сохранением состояния в БД
 *
 * Class TaskManagerDB
 * @package App\Common\Worker
 */

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\TaskProcess;
use App\Common\Config\Config;

class TaskManagerDB extends TaskManager {
    private $entityManager;

    public function __construct(EntityManagerInterface $em, int $timeout, array $arList = [], string $session_id = '')
    {
        parent::__construct($timeout, $arList, $session_id);
        $this->entityManager = $em;
    }

    /**
     * Читаем состояние сессии выполнения из БД на основе session_id
     * если session_id пусто, значит сессия еще не создана
     * 
     * @return void 
     * @throws TaskManagerStateException
     */    
    protected function loadState() {
        $this->processState = new TaskProcessState;

        if(empty($this->getSessionId())) {
            // идентификатора еще нет, значит добавляем объект
            $taskProcess = new TaskProcess;
            $taskProcess->setWorkerState(\serialize(new Config));
            $this->entityManager->persist($taskProcess);
            $this->entityManager->flush();
            
            if (empty($taskProcess->getId()))
                throw new TaskManagerStateException("Ошибка добавления сессии");

            $this->setSessionId($taskProcess->getId());
        }
        else {
            $taskProcess = $this->entityManager->getRepository(TaskProcess::class)->find($this->getSessionId());
            
            if (!$taskProcess)
                throw new TaskManagerStateException("Не найдена запрашиваемая сессия ".$this->getSessionId());

            // копируем
            $this->processState->setWorker($taskProcess->getWorkerIndex());
            $this->processState->setCurrent($taskProcess->getCurrentIndex());
            $this->processState->setSessionStartAt($taskProcess->getSessStartAt());
            $this->processState->setWorkerStartAt($taskProcess->getWorkStartAt());
            $this->processState->setWorkerUpdateAt($taskProcess->getWorkUpdateAt());
            $this->processState->setError($taskProcess->getBError());
            $this->processState->setMessage($taskProcess->getMessage());

            $state = \unserialize($taskProcess->getWorkerState());
            if(!$state) $state = new Config;
            $this->processState->setWorkerState($state);  
        }
    }

    /**
     * Записываем состояние сессии выполнения из БД на основе session_id
     * если session_id пусто, значит что-то пошло не так
     * 
     * @return void 
     * @throws TaskManagerStateException
     */ 
    protected function saveState() {
        if(empty($this->getSessionId()))
            throw new TaskManagerStateException("Ошибка обновления сессии");

        $taskProcess = $this->entityManager->getRepository(TaskProcess::class)->find($this->getSessionId());
        if (!$taskProcess)
            throw new TaskManagerStateException("Не найдена запрашиваемая сессия ".$this->getSessionId());

        //$taskProcess->setId($this->getSessionId());
        $taskProcess->setWorkerIndex($this->processState->getWorker());
        $taskProcess->setCurrentIndex($this->processState->getCurrent());
        $taskProcess->setSessStartAt($this->processState->getSessionStartAt());
        $taskProcess->setWorkStartAt($this->processState->getWorkerStartAt());
        $taskProcess->setWorkUpdateAt($this->processState->getWorkerUpdateAt());
        $taskProcess->setBError($this->processState->IsError());
        $taskProcess->setMessage($this->processState->getMessage());
        $taskProcess->setWorkerState(\serialize($this->processState->getWorkerState()));

        // $this->entityManager->persist($taskProcess);
        $this->entityManager->flush();
    }
}