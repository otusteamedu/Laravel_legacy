<?php
/**
 * Description of CountryEvent.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Events\Models\Country;


use App\Models\Country;

abstract class CountryEvent
{

    /** @var Country */
    private $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

}