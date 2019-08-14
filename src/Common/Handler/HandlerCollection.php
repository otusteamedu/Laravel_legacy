<?php


namespace App\Common\Handler;

/**
 * Класс, управляющий списком конечных обработчиков
 * Используется для предоставления выбора обработчиков в форме создания поставщика,
 * поска обработчика в контроллере выполнения задания и т.д.
 *
 * Class HandlerCollection
 * @package App\Common\Handler
 */
class HandlerCollection
{
    /**
     * Список существующих обработчиков,
     * инициализиется при создании объекта
     *
     * @var array
     */
    private $arData = null;

    public function __construct() {
        $this->arData = null;
    }

    /**
     * @param string $type
     * @return array
     */
    public function getList(string $type = '') : array {
        if(empty($this->arData)) {
            // .... вынуть из зависимостей по тегу или еще как-то
            // может прочитать из папки
        }

        return $this->arData;
    }

    /**
     * @param string $handlerId
     * @return IHandler
     */
    public function find(string $handlerId) : IHandler {
        $result = null;
        foreach($this->arData as $handler)
            if($handlerId == $handler->getId()) {
                $result = $handler;
                break;
            }

        return $result;
    }
}