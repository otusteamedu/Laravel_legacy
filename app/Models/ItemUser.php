<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class ItemUser
 * @package App\Models
 *
 * @property integer id
 * @property integer item_id
 * @property integer user_id
 * @property string comment
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class ItemUser extends Pivot
{

}