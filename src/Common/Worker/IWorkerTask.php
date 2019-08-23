<?php

namespace App\Common\Worker;

use App\Common\Config\Config;

/**
 * Интерфейс задачи, которая может выполняться пошагово
 * Запуск задачи осуществляет объект класса TaskManager по алгоритму
 * 1. создание объекта
 * 2. в случае, если это первый вызов в сессии, выполняется метод initSession
 * 3. перед выполнением цикла итераций вызывается метод init
 *      с передачей туда последнего сохраненного состояния в виде объекта Config
 * 4. после выполнения цикла итераций задача должна вернуть текущее состояние в виде объекта Config
 */

interface IWorkerTask
{
    /**
     * единственный вызов этой функции только в начале сессии
     * @return bool - TRUE - инициалицация завершилась удачно,
     *              FALSE - провал, операцию отменяем
     */
    public function initSession(): bool;

    /**
     * единственный вызов этой функции только в конце сессии
     */
    public function finishSession();    

    /**
     * вызывается перед каждым циклом итераций
     * @return bool
     */
    public function init(Config $state, int $current): bool;

    /**
     * вызывается после каждого цикла итераций
     */
    public function finish() : Config;    

    /**
     * получить текущий шаг 
     */
    public function getCurrent() : int;

    /**
     * получить текущий шаг 
     */
    public function getPercentage() : float;

    /**
     * общее количество шагов
     */
    public function getTotal() : int;

    /**
     * выполняет итерацию
     */
    public function doAction();

    /**
     * задача полностью выполнена
     */
    public function IsDone() : bool;

    /**
     * выполнение прекращено, есть ошибка
     */
    public function IsError() : bool;

    /**
     * понятное описание последней итерации
     */
    public function getMessage() : string;

    /**
     * Постоянная конфигурация
     */
    public function getConfig() : Config;

    /**
     * Динамическое состояние
     */
    public function getState() : Config;
}
