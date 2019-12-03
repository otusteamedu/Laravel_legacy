<?php


namespace App\Repositories\Filters;

use App\Base\Repository\BaseFilter;
use App\Base\Service\Q;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends BaseFilter
{
    public function apply(Q $query): Builder {
        $builder = $this->builder;
        foreach ($query->filter as $key => $value) {
            // пустые значения не участвуют в поиске
            if(empty($value))
                continue;

            switch ($key) {
                case 'name':
                    $exact = isset($filter['name_exact']) && $filter['name_exact'];
                    if($exact)
                        $builder->where('movies.name', '=', $value);
                    else
                        $builder->where('movies.name', 'like', '%'.$value.'%');
                    break;
                case 'roleId':
                    $builder
                        ->join('user_role', 'users.id', '=', 'user_role.role_id');
                    if(is_array($value))
                        $builder->whereIn('user_role.role_id', $value);
                    else
                        $builder->where('user_role.role_id', '=', $value);
                    break;
            }
        }

        return $builder;
    }
}
