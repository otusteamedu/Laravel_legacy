<?php

namespace Solyaris\App;

use Solyaris\Cmd\ICmdDispatcher;

interface IApp
{
    /**
     * Запустить
     *
     * @return int
     */
    public function run(): int;
    /**
     * Остановить цикл выполнения приложения
     */
    public function stop(): void;
    /**
     * Перечитать конфигурацию
     */
    public function reload(): void;
    /**
     * Ссылка на дистпетчер команд
     *
     * @return ICmdDispatcher
     */
    public function getCmdDispatcher() : ICmdDispatcher;
    /**
     * Писать строку в поток вывода
     *
     * @param string $string
     */
    public function write(string $string): void;
    /**
     * Писать строку с переносом в поток вывода
     *
     * @param string $string
     */
    public function writeLn(string $string): void;
    /**
     * Писать строку в поток ошибок
     *
     * @param string $string
     */
    public function error(string $string): void;
    /**
     * Писать строку с переносом в поток ошибок
     *
     * @param string $string
     */
    public function errorLn(string $string): void;
    /**
     * Прочитать строку из потока ввода длиной $length байт
     *
     * @param int $length
     * @return string|null
     */
    public function read(int $length = 0): ?string;

    /**
     * Прочитать строку из потока ввода до знака переноса
     *
     * @return string|null
     */
    public function readLn(): ?string;
    /**
     * Получить конфигурацию приложения
     *
     * @return Config
     */
    public function getConfig(): Config;
}