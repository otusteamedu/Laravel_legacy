<?php


namespace App\Models\Transport;


use App\Models\Validator\ValidatorInterface;


interface TransportInterface
{

    public function isAvailable(ValidatorInterface $validator, $date);

    public function get($id);

    public function store();
}
