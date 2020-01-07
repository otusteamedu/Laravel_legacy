<?php


namespace App\Repositories\Filters;

use App\Base\Repository\BaseFilter;
use App\Base\Service\Q;
use App\Helpers\Views\AdminHelpers;
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
                case 'name' :
                case 'surname' :
                case 'email' :
                    $exact = isset($query->filter[$key . '_exact']) && $query->filter[$key . '_exact'];
                    if($exact)
                        $builder->where('users.' . $key, '=', $value);
                    else
                        $builder->where('users.' . $key, 'like', '%'.$value.'%');
                    break;
                case 'roleId' :
                    $builder
                        ->join('user_role', 'users.id', '=', 'user_role.role_id');
                    if(is_array($value))
                        $builder->whereIn('user_role.role_id', $value);
                    else
                        $builder->where('user_role.role_id', '=', $value);
                    break;
                case 'phone' :
                    $value = AdminHelpers::normalizePhone($value);
                    $builder->where('users.phone', '=', $value);
                    break;
            }
        }

        return $builder;
    }
}
