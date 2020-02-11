<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\OperationSaved;

class Operation extends Model
{
    protected $dispatchesEvents = [
        'saved' => OperationSaved::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sum', 'category_id', 'description', 'user_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
