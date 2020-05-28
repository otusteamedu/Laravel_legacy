<?php
/**
 * Description of CachedIncomeRepositoryInterface.php
 */

namespace App\Services\Income\Repositories;


use App\Models\Income;

interface CachedIncomeRepositoryInterface
{

    public function sum($search, $userId);

    public function search($search, $userId);

    public function clearSearchCache();

    public function getIncomeUsersIds();

}
