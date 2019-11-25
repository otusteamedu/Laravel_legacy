<?php

namespace App\Models;

use App\Base\Repository\TListItem;
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
    use TListItem;
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
