<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Upload
 *
 * @property int id
 * @property int file_id
 * @property int user_id
 * @property int sort
 * @property string session_id
 * @property string url
 * @property string field
 * @property string description
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property File file
 * @property User owner
 *
 * @package App\Models
 */
class Upload extends Model
{
    protected $fillable = [
        'sort',
        'field',
        'session_id',
        'url',
        'description',
        'created_at',
        'updated_at'
    ];

    protected $attributes = [
        'sort' => 0,
    ];

    public $timestamps = true;

    public function file() : BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
