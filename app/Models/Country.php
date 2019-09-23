<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * @property int id
 * @property int sort
 * @property string name
 * @package App\Models\Movie
 */
class Country extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    protected $attributes = [
        'name' => '',
        'sort' => 10
    ];

    public $timestamps = false;
}
