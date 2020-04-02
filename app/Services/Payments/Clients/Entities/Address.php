<?php
/**
 * Description of Address.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Clients\Entities;


use App\Services\Invoices\Exceptions\ZipValidationException;

class Address
{
    private $country;
    private $city;
    private $zip;
    private $lines;

    public function __construct($country, $city, $zip, $lines)
    {
        $this->zip = $this->validateZip($zip);
        $this->country = $country;
        $this->city = $city;
        $this->zip = $zip;
        $this->lines = $lines;
    }

    private function validateZip($zip)
    {
        if (!preg_match('/^\d+$/', $zip)) {
            throw new ZipValidationException($zip);
        }

        return $zip;
    }
}
