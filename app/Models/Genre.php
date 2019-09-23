<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Genre
 * @property int id
 * @property int sort
 * @property string name
 * @property string description
 * @package App\Models
 */
class Genre extends Model
{
    //
    protected $fillable = [
        'name', 'description'
    ];

    protected $attributes = [
        'name' => '',
        'sort' => 10,
        'description' => ''
    ];
    public $timestamps = false;
}
