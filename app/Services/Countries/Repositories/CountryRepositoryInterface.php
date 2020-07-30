<?php
/**
 * Description of CountryRepositoryInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface CountryRepositoryInterface
{
    public function find(int $id);

    public function getBy(array $filters = [], array $with = [], ?int $limit = null, ?int $offset = null): Collection;

    public function search(array $filters = [], array $with = []);

    public function createFromArray(array $data): Country;

    public function updateFromArray(Country $country, array $data);
}
