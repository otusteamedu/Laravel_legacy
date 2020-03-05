<?php
/**
 * Description of CacheNewsRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\News\Repositories;


interface NewsRepositoryInterface
{

    public function latest(): array;

}
