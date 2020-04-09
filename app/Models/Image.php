<?php

namespace App\Models;


use App\Events\Models\Image\ImageDeleted;
use App\Events\Models\Image\ImageSaved;
use App\Events\Models\Image\ImageUpdated;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;

class Image extends Model
{
    use Searchable;

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dispatchesEvents = [
        'saved' => ImageSaved::class,
        'updated' => ImageUpdated::class,
        'deleted' => ImageDeleted::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany('App\Models\Category')
            ->wherePivot('category_type', 'topics');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany('App\Models\Category')
            ->wherePivot('category_type', 'colors');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function interiors()
    {
        return $this->belongsToMany('App\Models\Category')
            ->wherePivot('category_type', 'interiors');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\Owner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function format()
    {
        return $this->belongsTo('App\Models\Format');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    /**
     * @param $query
     * @param array $filter
     * @return mixed
     */
    public function scopeFiltered($query, array $filter)
    {
        list('categories' => $categories, 'tags' => $tags) = $filter;

        return $query
            ->whereHas('tags', function (Builder $query) use ($tags) {
                $query->whereIn('id', $tags);
            })
            ->orWhereHas('categories', function (Builder $query) use ($categories) {
                $query->whereIn('id', $categories);
            });
    }
}
