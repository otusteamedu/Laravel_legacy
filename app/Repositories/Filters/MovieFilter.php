<?php


namespace App\Repositories\Filters;


use App\Base\Repository\BaseFilter;

class MovieFilter extends BaseFilter
{
    public function apply(array $filter, array $order) {
        $b = $this->builder;

        foreach ($filter as $key => $value) {
            switch ($key) {
                case 'name':
                    $exact = isset($filter['name_exact']) && $filter['name_exact'];
                    if($exact)
                        $this->builder->where('name', '=', $value);
                    else
                        $this->builder->where('name', 'like', '%'.$value.'%');
                    break;

                case 'genreId':

                case 'countryId':

            }
        }
        return $this->builder;
    }
}
