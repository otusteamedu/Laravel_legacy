<?php


namespace App\Base\Service;

/**
 * Class Q
 *
 * Чтобы исключить большие строки запросов в getList можно использовать класс Q
 *
 * @package App\Base\Service
 */
class Q
{
    public $filter;
    public $order;
    public $nav;
    public $select;

    public function __construct(
        array $filter = [],
        array $order = [],
        array $nav = [],
        array $select = []
    ) {
        $this->filter = $filter;
        $this->order = $order;
        $this->nav = $nav;
        // пока этот элемент не используем
        $this->select = $select;
    }

    public function filter(array $data): Q {
        $this->filter = $data;
        return $this;
    }

    public function order(array $data): Q {
        $this->order = $data;
        return $this;
    }

    public function select(array $data): Q {
        $this->select = $data;
        return $this;
    }

    public function nav(array $data): Q {
        $this->nav = $data;
        return $this;
    }

    public function getNav() {
        return $this->nav;
    }

    public function haveNav() {
        return !empty($this->nav);
    }
}
