<?php


namespace App\Repositories\Filters;


use App\Base\Repository\BaseFilter;
use App\Base\Service\Q;
use Illuminate\Database\Eloquent\Builder;

class OrderFilter extends BaseFilter
{
    public function apply(Q $query): Builder {
        $builder = $this->builder;
        foreach ($query->filter as $key => $value) {
            // пустые значения не участвуют в поиске
            if(empty($value))
                continue;

            switch ($key) {
                case 'buyerId':
                    $builder->where('orders.buyer_id', '=', $value);
                    break;
                case 'isOrdered':
                    if($value == 'y') {
                        $builder->where('orders.status', '<>', 'cart');
                    }
                    else if($value == 'n') {
                        $builder->where('orders.status', '=', 'cart');
                    }
                    break;
                case 'status':
                    $builder->where('orders.status', '=', $value);
                    break;
            }
        }

        return $builder;
    }
}
