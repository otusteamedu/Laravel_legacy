<?php

namespace App\Common\Worker;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Пошаговое выполнение с сохранением состояния в БД
 *
 * Class TaskManagerSess
 * @package App\Common\Worker
 */

class TaskManagerSess extends TaskManager {
    private $sessionManager;

    public function __construct(SessionInterface $sm, int $timeout, array $arList = [], string $session_id = '')
    {
        parent::__construct($timeout, $arList, $session_id);
        $this->sessionManager = $sm;
    }

    /**
     * Читаем состояние сессии выполнения из сессии HTTP на основе session_id
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
            //$this->entityManager->persist($taskProcess);
            //$this->entityManager->flush();

            if (empty($taskProcess->getId()))
                throw new TaskManagerStateException("Ошибка добавления сессии");

            $this->setSessionId($taskProcess->getId());
        }
        else {
            //$taskProcess = $this->entityManager->getRepository(TaskProcess::class)->find($this->getSessionId());

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
            $this->processState->setWorkerState(\unserialize($taskProcess->getWorkerState()));
        }
    }

    /**
     * Записываем состояние сессии выполнения из сессию HTTP на основе session_id
     * если session_id пусто, значит что-то пошло не так
     * 
     * @return void 
     * @throws TaskManagerStateException
     */ 
    protected function saveState() {
        if(empty($this->getSessionId()))
            throw new TaskManagerStateException("Ошибка обновления сессии");

        $taskProcess = new TaskProcess();

        $taskProcess->setId($this->getSessionId());
        $taskProcess->setWorkerIndex($this->processState->getWorker());
        $taskProcess->setCurrentIndex($this->processState->getCurrent());
        $taskProcess->setSessStartAt($this->processState->getSessionStartAt());
        $taskProcess->setWorkStartAt($this->processState->getWorkerStartAt());
        $taskProcess->setWorkUpdateAt($this->processState->getWorkerUpdateAt());
        $taskProcess->setBError($this->processState->IsError());
        $taskProcess->setMessage($this->processState->getMessage());
        $taskProcess->getWorkerState(serialize($this->processState->getWorkerState()));

        //$this->entityManager->persist($taskProcess);
        //$this->entityManager->flush();
    }
}    