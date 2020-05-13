<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Instructor
 * @package App\Models
 * @property int instructor_id
 * @property string name

 */
class Instructor extends Model
{
    protected $fillable = [
        'instructor_id', 'name',
    ];
/*
    public function styles()
    {
        return $this->belongsToMany('App\Models\Style');
    }
*/
}
