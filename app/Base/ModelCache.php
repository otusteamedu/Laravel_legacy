<?php


namespace App\Base;

/**
 * Класс, реализующий логику забывания ключей и тегов
 *
 * Class ModelCache
 * @package App\Base
 */
abstract class ModelCache
{
    protected $event;

    public function __construct(ModelEvent $event) {
        $this->event = $event;
    }

    abstract public function getForgetKeys(): array;

    abstract public function getForgetTags(): array;
}
