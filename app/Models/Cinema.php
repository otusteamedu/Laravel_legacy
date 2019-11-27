<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Cinema
 *
 * @property int id
 * @property string name
 * @property string address
 * @property string description
 * @property array location
 * @property int created_user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property File[]|\Illuminate\Database\Eloquent\Collection photos
 * @property User owner
 *
 * @package App\Models
 */

class Cinema extends Model
{
    protected $fillable = [
        'name',
        'address',
        'description',
        'location',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'location' => 'array',
    ];

    public $timestamps = true;

    public function photos() {
        return $this
            ->belongsToMany('App\Models\File', 'cinema_photos', 'cinema_id', 'photo_id')
            ->using('App\Models\CinemaPhoto');
    }

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
}
