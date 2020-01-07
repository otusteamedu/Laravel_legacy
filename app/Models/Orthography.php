<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orthography extends Model
{


    protected $fillable = ['id','name',
        'title','code','meta_keywords',
        'meta_description','harf_name',
        'harf_free','harf_first',
        'harf_center','harf_last',
        'harf_free_img','harf_first_img',
        'harf_center_img','harf_last_img',
        'harf_name_sound','harf_fatha_sound',
        'harf_kesra_sound','harf_damma_sound',
        'harf_saken_sound','img_tell',
        'text_about','text_for_reading'];


    protected $guarded = ['_method', '_token'];
}
