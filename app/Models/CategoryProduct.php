<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @proprety Country country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryProduct query()
 * @mixin \Eloquent
 */

class CategoryProduct extends Model
{
    protected $fillable = ['name','description'];

    public function product(){
        return $this->belongsTo(Product::class, 'category_id','id');
    }
}
