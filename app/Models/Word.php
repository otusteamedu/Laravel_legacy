<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = [
        'id','ar_word','ar_word_mn', 'rus_word','rus_word_mn',
        'word_type', 'fig_simpol', 'lessen_id'
    ];
    protected $guarded = ['_method','_token'];
}
