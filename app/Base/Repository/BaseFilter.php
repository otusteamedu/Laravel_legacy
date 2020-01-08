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
    public function apply(Q $query): Builder {
        $builder = $this->builder;
        $tableName = $builder->getModel()->getTable();

        if(!empty($query->select))
            $builder->select($query->select);
        else
            $builder->select([$tableName.'.*']);
/*
        if(!empty($query->order)) {
            foreach($query->order as $field => $order)
                if($order == "desc")
                    $builder->orderByDesc($field);
                else
                    $builder->orderBy($field);
        }
        else
            $builder->orderBy($tableName.'.id');
*/
        return $builder;
    }
}
