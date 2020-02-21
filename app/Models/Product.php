<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Products
 * @package App\Models
 *
 */

class Product extends Model
{

    protected $fillable = ['name','description','category_id','price','created_user_id'];

    public function category(){
        return $this->hasOne(CategoryProduct::class, 'id','category_id');
    }
}
