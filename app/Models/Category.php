<?php

namespace App\Models;

use App\Events\Models\Category\CategoryDeleted;
use App\Events\Models\Category\CategorySaved;
use App\Events\Models\Category\CategoryUpdated;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dispatchesEvents = [
        'saved' => CategorySaved::class,
        'updated' => CategoryUpdated::class,
        'deleted' => CategoryDeleted::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images() {
        return $this->belongsToMany('App\Models\Image');
    }
}
