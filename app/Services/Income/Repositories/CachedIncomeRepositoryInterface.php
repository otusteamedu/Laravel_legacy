<?php
/**
 * Description of CachedIncomeRepositoryInterface.php
 */

namespace App\Services\Income\Repositories;


use App\Models\Income;

interface CachedIncomeRepositoryInterface
{

    public function sum();

    public function search();

    public function clearSearchCache();

}
