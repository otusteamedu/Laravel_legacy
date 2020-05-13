<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Style
 * @package App\Models
 * @property int style_id
 * @property string name

 */
class Style extends Model
{
    protected $fillable = [
        'style_id', 'name',
    ];

    public function instructors()
    {
        return $this->belongsToMany('App\Models\Style');
    }
}
