<?php

namespace App\Models;

use App\Base\Repository\TListItem;
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
    use TListItem;
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
