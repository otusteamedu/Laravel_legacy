<?php

namespace App\Models;

use App\Base\Repository\TListItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Role
 *
 * @property int id
 * @property string name
 * @property string code
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @package App\Models
 */
class Role extends Model
{
    use TListItem;
    //

    public function access(): BelongsToMany {
        return $this->belongsToMany(ModAccess::class , 'mod_perms' , 'access_id' , 'role_id');
    }
}
