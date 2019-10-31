<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class Models
{
    /**
     * Get table name from Model class name
     *
     * @param  string  $modelClass
     *
     * @return string
     */
    public static function getTableName(string $modelClass): string
    {
        /** @var Model $model */
        $model = (new $modelClass);
    
        return $model->getTable();
    }
}
