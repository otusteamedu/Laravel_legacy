<?php


namespace App\Models\Validator;


use App\Models\Transport\Transport;


interface ValidatorInterface
{
    public function isAvailable(Transport $transport, $date): bool;
}
