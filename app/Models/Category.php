<?php

namespace App\Models;

use App\Events\Models\Category\CategoryDeleted;
use App\Events\Models\Category\CategorySaved;
use App\Events\Models\Category\CategoryUpdated;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * @param $query
     * @param int $categoryId
     * @return mixed
     */
    public function scopeGetFilters($query, int $categoryId) {
        return $query
            ->where('id', '<>', $categoryId)
            ->whereHas('images', function (Builder $query) use ($categoryId) {
                $query->whereHas('categories', function (Builder $query) use ($categoryId) {
                    $query->where('id', $categoryId);
            });
        });
    }

    /**
     * @param $query
     * @param array $ids
     * @return mixed
     */
    public function scopeGetFiltersByImageIds($query, array $ids) {
        return $query
            ->whereHas('images', function (Builder $query) use ($ids) {
                $query->whereIn('id', $ids);
            })
            ->published()
            ->withCount(['images' => function (Builder $query) use ($ids) {
                $query->whereIn('id', $ids);
            }])
            ->get();
    }

//    /**
//     * @param $query
//     * @param array $ids
//     * @return mixed
//     */
//    public function scopeWithImageCountWhereInId($query, array $ids) {
//        return $query
//            ->withCount(['images' => function (Builder $query) use ($ids) {
//                $query->whereIn('id', $ids);
//            }]);
//    }

    /**
     * @param $query
     * @param int $categoryId
     * @return mixed
     */
    public function scopeWithImageCountWhereCategoryId($query, int $categoryId)
    {
        return $query->withCount(['images' => function (Builder $query) use ($categoryId) {
            $query->whereHas('categories', function (Builder $query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }]);

    }
}
