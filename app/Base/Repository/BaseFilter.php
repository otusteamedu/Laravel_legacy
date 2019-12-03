<?php


namespace App\Base\Repository;
use App\Base\Service\Q;
use Illuminate\Database\Eloquent\Builder;

/**
 * На базовом
 *
 * Class BaseFilter
 * @package App\Base\Repository
 */
abstract class BaseFilter
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
     * @param Q|null $query
     * @return Builder
     */
    abstract public function apply(Q $query): Builder;
}
