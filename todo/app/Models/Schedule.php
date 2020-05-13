<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Schedule
 * @package App\Models
 * @property int style_id
 * @property int instructor_id
 * @property string days
 * @property string time
 * @property string instructor
 * @property string style

 */
class Schedule extends Model
{
    protected $table = 'schedules';
    protected $fillable = [
        'style_id', 'instructor_id', 'days', 'time'
    ];

    public function instructor()
    {
        return $this->hasOne('App\Models\Instructor', 'instructor_id', 'instructor_id');
    }

    public function style()
    {
        return $this->hasOne('App\Models\Style', 'style_id', 'style_id');
    }

}
