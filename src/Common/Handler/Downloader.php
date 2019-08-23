<?php

namespace App\Common\Handler;

use App\Common\Config\Option;
use App\Common\Config\Options;

/**
 * Принимает на вход массив файлов или один файл и загружает их в целевую папку
 *
 * Class Downloader
 * @package App\Common\Handler
 */
class Downloader extends Handler
{
    /**
     * размер пакета по-умолчанию, кБ
     */
    const PACKET_SIZE = 1024;

    public function initSession(): bool
    {
        // TODO: с помощью запроса HEAD определим
        // 1. Существует ли файл 2. Размер файла 3. Поддерживается ли закачка кусками

        // $this->getState()->set('acceptRange', $acceptRange);
        // $this->getState()->set('fileSize', $fileSize);

        return parent::initSession();
    }

    public function getOptions(): Options
    {
        return new Options(
            [
                new Option('url', Option::T_STRING, 'Файл для загрузки', ''),
                new Option('packetSize', Option::T_NUMBER, 'Размер одного шага, кБ', self::PACKET_SIZE),
                new Option('authLogin', Option::T_STRING, 'Логин', ''),
                new Option('authPassword', Option::T_STRING, 'Пароль', '')
            ]
        );
    }

    public function doAction()
    {
        // качаем часть файла размером packetSize() байт, начиная с getCurrent() * packetSize() байта
    }

    public function getTotal(): int {
        $total = $this->getState()->get('fileSize');
        $packetSize = $this->packetSize();

        return intval($total / $packetSize) + ($total % $packetSize > 0 ? 1 : 0);
    }

    public function getType(): string {
        return 'in';
    }

    public function getId(): string {
        return 'downloader';
    }

    private function packetSize() : int {
        $packetSize = $this->getParam('packetSize');
        if($packetSize <= 0)
            $packetSize = self::PACKET_SIZE;
        return $packetSize * 1024;
    }
}