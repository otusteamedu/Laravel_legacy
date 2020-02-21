<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryProduct
 * @package App\Models
 */
class CategoryProduct extends Model
{
    protected $fillable = ['name','description','created_user_id'];

    public function product(){
        return $this->belongsTo(Product::class, 'category_id','id');
    }
}
