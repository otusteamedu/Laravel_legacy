<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    const TYPE_NEW_ACTION = 'new_action';
    const TYPE_ORDER_ACCEPTED = 'order_accepted';
    const TYPE_ORDER_SHIPPED = 'order_shipped';

    /**
     * @var string[]
     */
    protected $casts = [
        'need_to_send' => 'bool',
    ];

    /**
     * Пользователь, к которому принадлежит это письмо
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

}
