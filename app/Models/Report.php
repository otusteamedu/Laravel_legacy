<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * @package App\Models
 * @property int id
 * @property int project_id
 * @property string status
 *
 */
class Report extends Model
{
    protected $fillable = [
        'id',
        'project_id',
        'status',
    ];
}
