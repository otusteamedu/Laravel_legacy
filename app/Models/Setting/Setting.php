<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Models\Setting
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $value
 */
class Setting extends Model
{
    /** @inheritDoc */
    public $timestamps = false;

    /** @inheritDoc  */
    protected $fillable = [
        'name', 'title', 'value',
    ];
}
