<?php


namespace App\Models\Transport;


use App\Models\Validator\ValidatorInterface;


/**
 * App\Models\Transport\Bus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport\Bus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport\Bus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transport\Bus query()
 * @mixin \Eloquent
 */
class Bus extends Transport implements TransportInterface
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
