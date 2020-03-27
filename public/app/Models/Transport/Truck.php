<?php


namespace App\Models\Transport;


use App\Models\Validator\ValidatorInterface;


/**
 * Class Truck
 * @package App\Models\Transport
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
