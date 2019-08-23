<?php

namespace App\Common\Worker;

use App\Common\Config\Config;
use Exception;
use function time;

/**
 * Это основной класс, обеспечивающий пошаговое выполнение задач.
 * Каждая задача - объект интерфейса IWorkerTask
 *
 * Class TaskManager
 * @package App\Common\Worker
 */

/**
 * 1. Задача - объект р.и. IWorkerTask, состоит из элементарных атомарных задач, которые выполняются 
 *      методом doAction. Подробнее IWorkerTask.php. 
 *      Каждая атомарная задача выполняется в одной итерации
 * 2. Сессия - процесс полного выполнения задачи от первого до последнего шага
 * 3. Цикл итераций - совокупность последовательно выполняемых итераций. 
 *      Начинается цикл с последнего выполненного шага, выполнение ограничено разрешенным периодом цикла
 * 4. Шаг итерации - целое число, имеющее смысл только в контексте объекта задачи. 
 *      Определяет текущую точку выполняемое задачи
 * 5. Объем задачи - целое число которое описывает необходимое количество шагов итераций для выполнения
 *      задачи
 * 5. Период цикла итерации
 * 6. Итерация - атомарное логически изолированное действие
 *  
 */

abstract class TaskManager implements ITaskManager {
    /**
     * список задач
     * 
     * @var array массив воркеров IWorkerTask
     */
    private $arList;

    /**
     * веса задач в общем списке, для более точного информирования ползователей о ходе выполнения
     * веса определяются путем вдумчивого ковыряния в носу
     * 
     * @var array массив весов  
     */
    private $arWeights;

    /**
     * список задач
     * 
     * @var TaskProcessState
     */
    protected $processState;

    /**
     * период итерации, секунды 
     * 
     * @var int время, с
     */
    private $timeout;

    /**
     * идентификатор задачи. Если он пуст, то необходимо сгенерировать
     * 
     * @var array массив весов  
     */
    private $session_id;

    protected function __construct(int $timeout, array $arList = [], string $session_id = '')
    {
        $this->timeout = $timeout;

        foreach($arList as $worker) {
            $this->addWorker($worker, 1);
        }

        $this->session_id = $session_id;
        $this->processState = null;
    }
    
    /**
     * загружаем состояние последнего цикла итераций
     * можно будет грузить из http-сессии, из БД и т.д.
     * 
     * @return void 
	 * @throws TaskManagerStateException
     */

    abstract protected function loadState();

    /**
     * сохраняем состояние последнего цикла итераций
     * можно будет сохранить в http-сессии, в БД и т.д.
     * 
     * @return void 
	 * @throws TaskManagerStateException
     */    
    abstract protected function saveState();

    /**
     * При конструировании лучше использовать этот метод
     * 
	 * @param IWorkerTask $worker
     * @param int $nWeight
	 * @return TaskManager
     */
    final public function addWorker(IWorkerTask $worker, $nWeight = 1) : ITaskManager
    {
        $this->arList[] = $worker;
        $this->arWeights[] = $nWeight;

        return $this;
    }
    /**
     * Задается только один раз
     *
     * @return IWorkerTask
     * @throws TaskManagerException
     */
    private function currentWorker() : IWorkerTask
    {
        $this->assertState();

        $cnt = count($this->arList);
        $current = $this->processState->getWorker();
        if($current >= $cnt)
            throw new TaskManagerException();

        return $this->arList[$current];
    }
    /**
     * Задается только один раз
     *
     * @return void
     * @throws TaskManagerException
     */
    private function assertState() {
        if(is_null($this->processState))
            $this->loadState();
    }
    
    /**
     * главный и единственный не информационный публичный метод. Объект ITaskManager создается,
     * возможно принимает 1 или более воркеров и выполняется метод process().
     * Логика этого метода никогда не меняется.
     * Если process() вернет
     * - true, значит обработка завершена,
     * - false - требуется следующий вызов process()
     * 
     * @return bool
	 * @throws TaskManagerException
     * @throws TaskManagerStateException
     * @throws TaskManagerExecuteException
     */
    final public function process() : bool
    {
        // обязательно стоит первым!!!
        $this->assertState();  
        $ps = $this->processState; 
        $currentTime = time();
        $isStartSession = ($ps->getCurrent() <= 0) && ($ps->getWorker() <= 0);
        $isStartWorker = ($this->processState->getCurrent() <= 0);

        // иницаилизация воркера
        $isError = false;
        $worker = $this->currentWorker();
        if($isStartSession) {
            $ps->setSessionStartAt($currentTime);
        }

        if($isStartWorker) {
            $ps->setWorkerStartAt($currentTime);

            if(!$worker->initSession())
                $isError = true;
            else {
                $state = $worker->getState();
                $state->merge($ps->getWorkerState());
                if(!$worker->init($state, 0))
                    $isError = true;
            }
        }
        else {
            if(!$worker->init($ps->getWorkerState(), $ps->getCurrent()))
                $isError = true;
        }

        if($isError)
            throw new TaskManagerExecuteException($worker->getMessage());

        if($worker->getTotal() <= 0)
            throw new TaskManagerExecuteException("Объем задачи должен быть положительным числом");

        if(($worker->getCurrent() < 0) || ($worker->getCurrent() > $worker->getTotal()))
            throw new TaskManagerExecuteException("Теущий шаг задан неверно ".
                $worker->getCurrent()." [".$worker->getTotal()."]");

        // воркер работает пока, задача не выполнена или вышло разрешенное время
        $stage = $ps->getWorker();
        do {
            $worker->doAction();

            $isError = $worker->IsError();
            $isDone = $worker->IsDone();
            $current = $worker->getCurrent();
            $bInterrupt = time() - $currentTime > $this->timeout;
            $bReturn = false;

            // задача завершена, идем к следующей, если она есть
            if($isDone) {
                $bInterrupt = true;
                if($stage >= count($this->arList) - 1) {
                    $bReturn = true;
                }
                else {
                    $stage++;
                    $current = 0;
                }
            }

            if($isError)
                $bInterrupt = true;
        }
        while(!$bInterrupt);

        $workerState = $worker->finish();
        if($isDone) {
            $worker->finishSession();
            $workerState = new Config;
        }    
        $ps 
            ->setWorker($stage)
            ->setCurrent($current)
            ->setWorkerUpdateAt(time())
            ->setMessage($worker->getMessage())
            ->setError($isError)
            ->setWorkerState($workerState);
        $this->saveState();

        if($isError)
            throw new TaskManagerExecuteException($worker->getMessage());

        return $bReturn;
    }

    public function getSessionId() : string {
        return $this->session_id;
    }

    /**
     * Задается только один раз
     *
     * @param string $value идентификатор сессии
     * @return void
     * @throws TaskManagerException
     */
    protected function setSessionId(string $value) {
        if(!empty($this->session_id))
            throw new TaskManagerException("ID сессии можно задать только один раз");
        $this->session_id = $value;
    }

    public function getPercentage() : float {
        $totalWeight = 0;
        $currentWeight = 0;

        try {
            $this->assertState();
            $ps = $this->processState;

            foreach($this->arList as $index => $worker) {
                $totalWeight += $this->arWeights[$index];
                if($index < $ps->getWorker())
                    $currentWeight += $this->arWeights[$index];
                elseif($index == $ps->getWorker())
                    $currentWeight += $this->arWeights[$index] * $worker->getPercentage() / 100;
            }
        }
        catch (Exception $e) {}

        return $currentWeight / $totalWeight;
    }

    public function getMessage() : string {
        $message = "";
        try {
            $this->assertState();
            $worker = $this->currentWorker();
            $message = $worker->getMessage();
        }
        catch (Exception $e) {}
        return $message;
    }
}

class TaskManagerException extends Exception {}

class TaskManagerStateException extends TaskManagerException {}

class TaskManagerExecuteException extends TaskManagerException {}