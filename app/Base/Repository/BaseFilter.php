<?php


namespace App\Base\Repository;
use Illuminate\Database\Eloquent\Builder;

/**
 * На базовом
 *
 * Class BaseFilter
 * @package App\Base\Repository
 */
class BaseFilter
{
    protected $builder;
    protected $macros;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
        $this->macros = [];
    }
    /**
     * Этот фильтр применяется в контексте конкретной модели.
     * Все элементы массива имеют смысл только в рамках конкретной реалицации фильтра
     *
     * @param array $filter
     * @return Builder
     */
    public function apply(array $filter, array $order) {
        return $this->builder;
    }
}
