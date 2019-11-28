<?php

namespace App\Models;

use App\Base\Repository\TListItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    use TListItem;
    //
    protected $fillable = [
        'name',
        'description'
    ];

    protected $attributes = [
        'name' => '',
        'description' => ''
    ];
    protected $table = 'people';
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function photo() : BelongsTo
    {
        return $this->belongsTo(File::class, 'photo_id');
    }
}
