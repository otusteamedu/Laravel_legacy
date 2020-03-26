<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    const TEMPLATE_NEW_ACTION = 'new_action';
    const TEMPLATE_ORDER_ACCEPTED = 'order_accepted';
    const TEMPLATE_ORDER_SHIPPED = 'order_shipped';

    // статусы отправки писем
    const STATUS_NEW = 0;
    const STATUS_PROCESSING = 10;
    const STATUS_SENT = 20;
    const STATUS_CANCELLED = 30;
    const STATUS_FAILED = 40;

    /**
     * @var string[]
     */
    protected $casts = [
        //'need_to_send' => 'bool',
        'status'=>'string'
    ];

    /**
     * Пользователь, к которому принадлежит это письмо
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
