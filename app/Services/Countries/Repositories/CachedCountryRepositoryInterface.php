<?php
/**
 * Description of CachedCountryRepositoryInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Models\Country;

interface CachedCountryRepositoryInterface
{

    public function searchByNames(string $name);

    public function clearSearchCache();

    public function find(int $id);

    public function clearCountryCache(Country $country);

}
