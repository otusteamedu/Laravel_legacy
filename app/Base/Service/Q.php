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
    )
    {
        $this->filter = $filter;
        $this->order = $order;
        $this->nav = $nav;
        $this->select = $select;
    }

    public function filter(array $data): Q {
        $query = is_object($this) ? $this : new self();
        $query->filter = $data;

        return $query;
    }

    public function order(array $data): Q {
        $query = is_object($this) ? $this : new self();
        $query->order = $data;

        return $query;
    }

    public function select(array $data): Q {
        $query = is_object($this) ? $this : new self();
        $query->select = $data;

        return $query;
    }

    public function nav(array $data): Q {
        $query = is_object($this) ? $this : new self();
        $query->nav = $data;

        return $query;
    }

    public function getNav() {
        return $this->nav;
    }
}
