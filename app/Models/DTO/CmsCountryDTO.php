<?php
/**
 * Description of CmsCountryDTO.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Models\DTO;


use App\Models\Country;

class CmsCountryDTO
{
    private $id;

    protected function __construct(
        int $id
    )
    {
        $this->id = $id;
    }

    public static function fromCountry(Country $country)
    {
        return new self($country->id);
    }

    public static function fromArray(array $data)
    {
        return new self(
            $data['id']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
        ];
    }

}