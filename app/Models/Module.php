<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Module
 *
 * @property int id
 * @property int sort
 * @property string name
 * @property string code
 * @property ModAccess[] accesses
 *
 * @package App\Models
 */

class Module extends Model
{
    //
    protected $fillable = [
        'name', 'sort', 'code'
    ];

    protected $attributes = [
        'name' => '',
        'sort' => 10,
        'code' => ''
    ];

    public $timestamps = false;

    /**
     * Get the post that owns the comment.
     */
    public function accesses()
    {
        return $this->hasMany(ModAccess::class, 'module_id', 'id');
    }
}
