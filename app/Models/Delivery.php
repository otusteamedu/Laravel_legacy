<?php

namespace App\Models;


use App\Events\Models\Delivery\DeliveryDeleted;
use App\Events\Models\Delivery\DeliverySaved;
use App\Events\Models\Delivery\DeliveryUpdated;

class Delivery extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dispatchesEvents = [
        'saved' => DeliverySaved::class,
        'updated' => DeliveryUpdated::class,
        'deleted' => DeliveryDeleted::class,
    ];
}
