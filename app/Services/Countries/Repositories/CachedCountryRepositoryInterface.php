<?php
/**
 * Description of CachedCountryRepositoryInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface CachedCountryRepositoryInterface
{

    public function getBy(array $filters = [], array $with = []): Collection;

    public function search(array $filters = [], array $with = []);

    public function clearSearchCache();

}