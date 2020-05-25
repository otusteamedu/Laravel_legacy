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
    public $timestamps = false;
    protected $fillable = [
        'style_id', 'name',
    ];

    public function instructors()
    {
        return $this->belongsToMany('App\Models\Style');
    }
}
