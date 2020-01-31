<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $fillable = ['name','description'];

    public function product(){
        return $this->belongsTo(Products::class, 'category_id','id');
    }
}
