<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App\Models
 * @property int id
 * @property string name
 * @property string description
 * @property int report_day
 *
 */
class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'name',
        'description',
        'report_day'
    ];
}
