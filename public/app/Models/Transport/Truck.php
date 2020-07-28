<?php


namespace App\Models\Transport;


use App\Models\Validator\ValidatorInterface;


/**
 * App\Models\Transport\Truck
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport\Truck newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport\Truck newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport\Truck query()
 * @mixin \Eloquent
 */
class Truck extends Transport implements TransportInterface
{
    public function isAvailable(ValidatorInterface $validator, $date)
    {
        return $validator->isAvailable($this, $date);
    }

    public function get($id)
    {
        // TODO: get() method
    }

    public function store()
    {
        // TODO: store() method
    }
}
