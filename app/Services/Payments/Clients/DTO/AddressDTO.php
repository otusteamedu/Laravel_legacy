<?php
/**
 * Description of AddressDTO.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Clients\DTO;


class AddressDTO
{
    public $country;
    public $city;
    public $zip;
    public $lines = [];

    public static function fromArray($data)
    {
        $self = new self();

        $self->country = $data['country'];
        $self->city = $data['city'];
        $self->zip = $data['zip'];
        $self->lines = $data['lines'];

        return $self;
    }
}
