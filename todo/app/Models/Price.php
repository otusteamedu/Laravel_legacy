<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Price
 * @package App\Models
 * @property int id
 * @property string description
 * @property int price

 */
class Price extends Model
{
    protected $fillable = [
        'id', 'description','price'
    ];


}
