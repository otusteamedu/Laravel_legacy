<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    const PUBLISHED = 1;

    public function scopePublished($query)
    {
        $query->where('publish', self::PUBLISHED);
    }
}
