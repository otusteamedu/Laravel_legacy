<?php
/**
 * Description of CachedCurrencyRepositoryInterface.php
 */

namespace App\Services\Currencies\Repositories;


use App\Models\Currency;

interface CachedCurrencyRepositoryInterface
{

    public function searchByCode(string $code);

    public function all();

    public function clearSearchCache();

    public function find(int $id);

    public function clearCurrencyCache(Currency $country);

}
