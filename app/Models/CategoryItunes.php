<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryItunes
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Podcast[] $podcasts
 * @property-read int|null $podcasts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItunes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItunes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryItunes query()
 * @mixin \Eloquent
 */
class CategoryItunes extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
}
