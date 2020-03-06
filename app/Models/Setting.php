<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group() {
        return $this->belongsTo('App\Models\SettingGroup');
    }

    const TYPES = [
        [
            'name' => 'text',
            'display_name' => 'Текстовое поле'
        ],
        [
            'name' => 'file',
            'display_name' => 'Изображение'
        ]
    ];
}
