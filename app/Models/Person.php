<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 * @property int id
 * @property string name
 * @property File photo
 * @property string description
 * @package App\Models\Movie
 */

class Person extends Model
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
    protected $table = 'people';
    public $timestamps = false;

    public function photo()
    {
        return $this->hasOne(File::class );
    }
}
