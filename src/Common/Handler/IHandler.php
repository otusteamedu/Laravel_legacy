<?php


namespace App\Common\Handler;

use App\Common\Config\Options;

/**
 * Интерфейс обработчика задач по
 * загрузке/выгрузке элементов в/из хранилища
 *
 * Interface IHandler
 * @package App\Common\Handler
 */
interface IHandler
{
    /**
     * Тип обработчика, служит для разделения обработчиков по назначению
     * например, парсеры для загрузке будут иметь тип 'parser',
     * выгрузка на сайт будет управляться 'loader'
     *
     * @return string
     */
    public function getType() : string;

    /**
     * Уникальный ID обработчика
     *
     * @return string
     */
    public function getId() : string;

    /**
     * получить коллекцию именованных настроек -
     * для возможности создавать поля в форме редактирования
     *
     * @return Options
     */
    public function getOptions() : Options;
}