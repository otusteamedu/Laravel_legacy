<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class QueryBuilder
 * Построитель запросов
 *
 * @package App\Helpers
 */
class QueryBuilder
{

    /** @var int Лимит записей */
    private $limit = 0;
    /** @var int Начинать с */
    private $offset = 0;
    /** @var array Подтянуть связи */
    private $with = [];
    /** @var array Фильтры */
    private $filters = [];

    /** @var int Кол-во подходящих записей */
    private $total = 0;

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function build(Builder $builder): Builder
    {
        foreach ($this->filters as $filter) {
            $builder->where(...$filter);
        }

        $this->total = $builder->count();

        if ($this->limit) {
            $builder->take($this->limit);
        }
        if ($this->offset) {
            $builder->skip($this->offset);
        }
        if ($this->with) {
            $builder->with($this->with);
        }
        return $builder;
    }

    /**
     * Установить лимит записи
     *
     * @param int $limit
     *
     * @return QueryBuilder
     */
    public function setLimit(int $limit): QueryBuilder
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Установить начало выборкки
     *
     * @param int $offset
     *
     * @return QueryBuilder
     */
    public function setOffset(int $offset): QueryBuilder
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Установить зависимости
     *
     * @param array $with
     *
     * @return QueryBuilder
     */
    public function setWith(array $with): QueryBuilder
    {
        $this->with = $with;
        return $this;
    }

    /**
     * Установить фильтры
     *
     * @param array $filters
     *
     * @return QueryBuilder
     */
    public function setFilters(array $filters): QueryBuilder
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Получить данные ввиде массива
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [];

        if ($this->filters) {
            $data['filters'] = $this->filters;
        }
        if ($this->with) {
            $data['with'] = $this->with;
        }
        if ($this->limit) {
            $data['limit'] = $this->limit;
        }
        if ($this->offset) {
            $data['offset'] = $this->offset;
        }
    }

    /**
     * Получить общее кол-во записей
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

}
