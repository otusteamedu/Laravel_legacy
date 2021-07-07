<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grammar extends Model{
    protected $fillable = [ 'id',
        'title', 'name', 'code','meta_keywords' , 'meta_description',
        'arabic_text', 'grammar_text','updated_at'];
    protected $guarded = ['_method','_token'];
//    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

}
