<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class ModuleAccess
 *
 * @property int id
 * @property int module_id
 * @property int sort
 * @property string name
 * @property string code
 * @property Module module
 *
 * @package App\Models
 */
class ModAccess extends Model
{
    //
    protected $fillable = [
        'name' , 'sort' , 'code'
    ];

    protected $attributes = [
        'name' => '' ,
        'sort' => 10 ,
        'code' => ''
    ];
    /**
     * Get the post that owns the comment.
     */
    public function module(): BelongsTo {
        return $this->belongsTo(Module::class , 'module_id');
    }
    public function roles(): BelongsToMany {
        return $this->belongsToMany(Role::class , 'mod_perms' , 'role_id' , 'access_id');
    }

    public $timestamps = false;
}
